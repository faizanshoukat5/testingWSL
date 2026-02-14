const tableContent = document.getElementById('table-container');
const bottomScrollbarContent = document.getElementById('bottom-scrollbar-content');

tableContent.addEventListener('scroll', () => {
	bottomScrollbarContent.scrollLeft = tableContent.scrollLeft;
});

bottomScrollbarContent.addEventListener('scroll', () => {
	tableContent.scrollLeft = bottomScrollbarContent.scrollLeft;
});