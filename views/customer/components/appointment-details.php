<h2>Upcoming Appointments</h2>

<?php if (isset($appointments) && is_array($appointments) && count($appointments) > 0): ?>
    <table>
        <thead>
        <tr>
            <th>Customer</th>
            <th>Vehicle</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            
        </tr>
        </thead>
        <tbody>
        <?php foreach ($appointments as $appointment): ?>
            <tr>
                <td><?= htmlspecialchars($appointment['customer_id']) ?></td>
                <td><?= htmlspecialchars($appointment['vehicle_details']) ?></td>
                <td><?= htmlspecialchars($appointment['appointment_date']) ?></td>
                <td><?= htmlspecialchars($appointment['appointment_time']) ?></td>
                <td><?= htmlspecialchars($appointment['status']) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No appointments found.</p>
<?php endif; ?>
