// add functionality for tab switching here, for now it's just static
const tabs = document.querySelectorAll('.tab-button');
tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        // add logic here to filter the data based on the tab selected (All, Complete, Pending, Rejected)
    });
});
