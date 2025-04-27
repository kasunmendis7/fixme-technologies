<div class="notification-wrapper" id="notificationWrapper">
    <div class="notification-bell" id="notificationBell">
        <i class="fa fa-bell"></i>
        <span class="notification-count" id="notificationCount">3</span>
    </div>

    <div class="notification-dropdown" id="notificationDropdown">
        <button id="clearAllBtn" style="margin: 5px 10px; padding: 5px 10px; background: #ff4d4d; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Clear All
        </button>
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

        fetch('/get-notifications-for-service-center') // Update this path if needed
            .then(res => res.text())
            .then(text => {
                console.log("RAW response text:", text);

                try {
                    const cleaned = text.trim().replace(/^data/, '');
                    const data = JSON.parse(cleaned);
                    console.log("Parsed JSON:", data);

                    if (Array.isArray(data) && data.length > 0) {
                        count.textContent = data.length;
                        count.style.display = 'inline-block';
                        list.innerHTML = '';
                        data.forEach(notification => {
                            const li = document.createElement('li');
                            li.textContent = notification.message;
                            li.setAttribute('data-id', notification.id);

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

        // Mutation observer to dynamically add mark-as-seen buttons
        const observer = new MutationObserver(() => {
            document.querySelectorAll('#notificationList li').forEach(li => {
                if (!li.querySelector('.mark-btn') && !li.classList.contains('no-action')) {
                    const btn = document.createElement('button');
                    btn.textContent = 'Mark as Seen';
                    btn.className = 'mark-btn';
                    btn.onclick = () => {
                        const id = li.getAttribute('data-id');
                        fetch(`/mark-notification-as-seen/${id}`, { method: 'POST' })
                            .then(res => {
                                if (res.ok) {
                                    li.classList.remove('unseen');
                                    btn.remove();
                                    btn.disabled = true;
                                    btn.textContent = 'Seen';
                                    btn.style.backgroundColor = '#ccc';
                                    btn.style.cursor = 'not-allowed';
                                }
                            });
                    };
                    li.appendChild(btn);
                }
            });
        });

        observer.observe(list, { childList: true, subtree: true });

        // Clear all notifications
        if (clearBtn) {
            clearBtn.addEventListener('click', () => {
                fetch('/clear-notifications-for-service-center', { method: 'POST' })
                    .then(res => {
                        if (res.ok) {
                            list.innerHTML = '<li class="no-action">No new notifications</li>';
                            const count = document.getElementById('notificationCount');
                            count.style.display = 'none';
                        }
                    });
            });
        }
    });
</script>