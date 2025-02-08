<?php

    namespace app\models;
    use app\core\DbModel;
    use app\core\Application;

    class Cart extends DbModel
    {
        public int $id;
        public int $cart_id;
        public int $user_id;
        public int $product_id;
        public int $quantity;
        public ?string $created_at = null;
        public ?string $updated_at = null;

        public function tableName(): string {
            return 'cart_items';
        } 

        public function attributes(): array {
            return ['cart_id','product_id','quantity'];
        }

        public function primaryKey(): string {
            return 'id';
        }

        // add a product to cart 
        public function addToCart(int $user_id, int $product_id, int $quantity) {
            //get the cart_id for the user 
            $sql = 'SELECT cart_id FROM customer WHERE cus_id = :cus_id';
            $stmt = self::prepare($sql);
            $stmt->bindValue(':cus_id', $user_id);
            $stmt->execute();
            $cart = $stmt->fetchColumn();
            
            //if user does not have an cart, then create a one 
            if (!$cart) {
                // $this->db->query("INSERT INTO cart (user_id) VALUES (?)", [$user_id]);
                // $cart = $this->db->lastInsertId();
                // $this->db->query("UPDATE customer SET cart_id = ? WHERE cus_id = ?", [$cart, $user_id]); 
                $stmt = Application::$app->db->pdo->prepare("INSERT INTO cart (user_id) VALUES (?)");
                $stmt->execute([$user_id]);

                // Get last inserted cart_id
                $cart = Application::$app->db->pdo->lastInsertId();

                // Update customer table with the cart_id
                $stmt = Application::$app->db->pdo->prepare("UPDATE customer SET cart_id = ? WHERE cus_id = ?");
                $stmt->execute([$cart, $user_id]); 
            }
            // $existing = $this->db->query("SELECT id FROM cart_items WHERE cart_id = ? AND product_id = ?", [$cart, $product_id])->fetchColumn();
            // Check if the product is already in the cart
            $stmt = Application::$app->db->pdo->prepare("SELECT id FROM cart_items WHERE cart_id = ? AND product_id = ?");
            $stmt->execute([$cart, $product_id]);
            $existing = $stmt->fetchColumn();

            if ($existing) {
                // $this->db->query("UPDATE cart_items SET quantity = quantity + ? WHERE id = ?", [$quantity, $existing]);
                // Update quantity if product exists in cart
                $stmt = Application::$app->db->pdo->prepare("UPDATE cart_items SET quantity = quantity + ? WHERE id = ?");
                $stmt->execute([$quantity, $existing]);
            } else {
                // $this->db->query("INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (?, ?, ?)", [$cart, $product_id, $quantity]);
                // Insert new product into cart_items
                $stmt = Application::$app->db->pdo->prepare("INSERT INTO cart_items (cart_id, product_id, quantity) VALUES (?, ?, ?)");
                $stmt->execute([$cart, $product_id, $quantity]);
            }

            return true;
           
        }

        //get all items for a specific user 
        public function getCartItems(int $user_id) {
            $db = Application::$app->db->pdo;
            $stmt = $db->prepare("
                SELECT ci.id, ci.product_id, ci.quantity, p.description, p.price, p.media 
                FROM cart_items ci
                JOIN cart c ON ci.cart_id = c.id
                JOIN product p ON ci.product_id = p.product_id
                WHERE c.user_id = ?
            "); 
            $stmt->execute([$user_id]);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } 

        //model to remove items from the cart 
        public function removeCartItem(int $user_id, int $product_id) {
            $db = Application::$app->db->pdo;

            $stmt = $db->prepare("SELECT id FROM cart WHERE user_id = ?");
            $stmt->execute([$user_id]);
            $cart = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$cart) {
                return false;
            }

            $cart_id = $cart['id'];

            $stmt = $db->prepare("DELETE FROM cart_items WHERE cart_id = ? AND product_id = ?");
            return $stmt->execute([$cart_id, $product_id]);
        }

        public function rules(): array
        {
            return [

            ];
        }

        public function updateRules(): array
        {
            return [

            ];
        }
            
    }
