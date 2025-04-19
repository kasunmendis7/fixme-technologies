<div class="recentCustomers">
    <div class="cardHeader">
        <h2>Recent Customers</h2>
    </div>

    <table>
        <?php if (!empty($recentCustomers)): ?>
            <?php foreach ($recentCustomers as $customer): ?>
                <tr>
                    <td width="60px">
                        <div class="imgBx">
                            <img src="<?php echo htmlspecialchars($customer['profile_picture'] ?? 'assets/technician-dashboard/default.jpg'); ?>" alt="">
                        </div>
                    </td>
                    <td>
                        <h4>
                            <?php echo htmlspecialchars($customer['fname']); ?><br>
                            <span>
                                <?php
                                    // Optional: display date or location if available. For now, showing appointment date as "location placeholder"
                                    echo date('M d, Y', strtotime($customer['appointment_date'])) . ' at ' . date('h:i A', strtotime($customer['appointment_time']));
                                ?>
                            </span>
                        </h4>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="2">
                    <p>No recent customers found.</p>
                </td>
            </tr>
        <?php endif; ?>
    </table>
</div>
