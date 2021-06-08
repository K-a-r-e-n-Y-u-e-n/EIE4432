function inputInfo() {
	var Role=document.getElementById("role").value;
	if(Role=="Student") {
		form=document.getElementById('reg');
		form.action='insertS.html';
		form.submit();
	}
	if(Role=="Teacher") {
		form=document.getElementById('reg');
		form.action='insertT.html';
		form.submit();
	}
}

function login()
{
	var Role=document.getElementById("role").value;;
	var id=document.getElementById("id").value;
	var pw=document.getElementById("pw").value;
	if(Role=="Teacher") {
		form=document.getElementById('log');
		form.action="checkTeach.php";
		form.submit();
	}
	if(Role=="Student") {
		form=document.getElementById('log');
		form.action="checkStd.php";
		form.submit();
	}
	if(Role=="Adminstrator") {
		if((id=="admin")&&(pw=="qwer")) {
			form=document.getElementById('log');
			form.action="admin.php";
			form.submit();
		}
		else {
			alert ("Invalid ID or Password");
		}
	}
}