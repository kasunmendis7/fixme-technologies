<div class="notification-wrapper" id="notificationWrapper">
  <div class="notification-bell" id="notificationBell">
    <i class="fa fa-bell"></i>
    <span class="notification-count" id="notificationCount">3</span>
  </div>
  <div class="notification-dropdown" id="notificationDropdown">
    <ul id="notificationList">
      <li>No new notifications</li>
    </ul>
  </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', () => {
        const list = document.getElementById('notificationList');
        const count = document.getElementById('notificationCount');

        const wrapper = document.getElementById('notificationWrapper');
        const dropdown = document.getElementById('notificationDropdown');

        fetch('/get-notifications-for-service-center') // Adjust the path as needed
            .then(res => res.text())  // Get raw response text
            .then(text => {
                console.log("RAW response text:", text);

                try {
                    // If the response has 'data' prefix, remove it
                    const cleaned = text.trim().replace(/^data/, '');

                    // Parse the cleaned response
                    const data = JSON.parse(cleaned);
                    console.log("Parsed JSON:", data);

                    // Check if the response is an array and render notifications
                    if (Array.isArray(data) && data.length > 0) {
                        count.textContent = data.length;
                        count.style.display = 'inline-block';
                        list.innerHTML = '';  // Clear previous notifications
                        data.forEach(notification => {
                            const li = document.createElement('li');
                            li.textContent = notification.message;

                            // Add 'unseen' class if it's not read
                            if (!notification.is_read) {
                                li.classList.add('unseen');
                            }

                            list.appendChild(li);
                        });
                    } else {
                        list.innerHTML = '<li>No new notifications</li>';
                        count.style.display = 'none';
                    }
                } catch (e) {
                    console.error("JSON parse error:", e, text);
                    list.innerHTML = '<li>Invalid notification format</li>';
                }
            })
            .catch(error => {
                console.error('Error fetching notifications:', error);
                list.innerHTML = '<li>Error loading notifications</li>';
            });

        // Optional: Toggle dropdown on hover
        // const bell = document.getElementById('notificationBell');
        // const dropdown = document.getElementById('notificationDropdown');

        // bell.addEventListener('mouseenter', () => {
        //     dropdown.style.display = 'block';
        // });

        // bell.addEventListener('mouseleave', () => {
        //     setTimeout(() => {
        //         dropdown.style.display = 'none';
        //     }, 300);
        // });

        // dropdown.addEventListener('mouseenter', () => {
        //     dropdown.style.display = 'block';
        // });

        // dropdown.addEventListener('mouseleave', () => {
        //     dropdown.style.display = 'none';
        // });

        let hideTimeout;

        wrapper.addEventListener('mouseenter', () => {
            clearTimeout(hideTimeout);
            dropdown.style.display = 'block';
        });

        wrapper.addEventListener('mouseleave', () => {
            hideTimeout = setTimeout(() => {
                dropdown.style.display = 'none';
            }, 300);
        });
    });

</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const list = document.getElementById('notificationList');
        const clearBtn = document.getElementById('clearAllBtn');

        // Attach mark-as-seen button dynamically after notifications load
        const observer = new MutationObserver(() => {
            document.querySelectorAll('#notificationList li').forEach(li => {
                if (!li.querySelector('.mark-btn') && !li.classList.contains('no-action')) {
                    const btn = document.createElement('button');
                    btn.textContent = 'Mark as Seen';
                    btn.className = 'mark-btn';
                    btn.onclick = () => {
                        const id = li.getAttribute('data-id');
                        fetch(`/mark-notification-as-seen?id=${id}`, { method: 'POST' })
                            .then(res => res.ok && li.classList.remove('unseen'))
                            .then(() => btn.remove());
                    };
                    li.appendChild(btn);
                }
            });
        });

        observer.observe(list, { childList: true, subtree: true });

        // Clear all notifications
        clearBtn.addEventListener('click', () => {
            fetch('/clear-notifications', { method: 'POST' })
                .then(res => res.ok && (list.innerHTML = '<li class="no-action">No new notifications</li>'))
                .then(() => {
                    const count = document.getElementById('notificationCount');
                    count.style.display = 'none';
                });
        });
    });
</script>