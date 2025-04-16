document.addEventListener('DOMContentLoaded', function () {
    const timeSelect = document.querySelector('#appointment_time');
    const dateInput = document.querySelector('#appointment_date');
    const serviceCenterId = document.querySelector('#service_center_id').value;

    dateInput.addEventListener('change', () => {
        const selectedDate = dateInput.value;
        if (!selectedDate) return;

        fetch('/fetch-appointment-dates', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                service_center_id: serviceCenterId,
                appointment_date: selectedDate
            })
        })
        .then(res => res.json())
        .then(bookedTimes => {
            const allSlots = generateTimeSlots('08:00', '17:00', 30);
            timeSelect.innerHTML = '<option value="">-- Select a time --</option>';

            allSlots.forEach(time => {
                if (!bookedTimes.includes(time)) {
                    const option = document.createElement('option');
                    option.value = time;
                    option.textContent = time;
                    timeSelect.appendChild(option);
                }
            });
        });
    });

    function generateTimeSlots(start, end, interval) {
        const slots = [];
        let [h, m] = start.split(':').map(Number);
        const [eh, em] = end.split(':').map(Number);

        while (h < eh || (h === eh && m < em)) {
            slots.push(`${h.toString().padStart(2, '0')}:${m.toString().padStart(2, '0')}`);
            m += interval;
            if (m >= 60) {
                m -= 60;
                h++;
            }
        }
        return slots;
    }
});