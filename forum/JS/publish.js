function checkInfo() {
	var select1 = document.getElementById('select1');
	var title = document.getElementById('title');
	var content = document.getElementById('content');

	if (select1.value == 0) {
		alert('请选择一个版块!');
		return false;
	} else if (title.value == '') {
		alert('请输入帖子标题!');
		return false;
	} else if (content.value == '') {
		alert('请输入内容!');
		return false;
	} else {
		return true;
	}
}