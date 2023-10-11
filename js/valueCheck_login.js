$(document).ready(function() {
	
	var signInSubmit = $('#signInSubmit');
	var userid = $('#userid');
	var userpw = $('#userpw');
	
	var valueError = $('#valueError');
	
	//가입 버튼을 눌렀을 때
	signInSubmit.click(function() {
		//ID 공백 검사
		if(userid.val() == '') {
			valueError.text('ID를 입력하세요.');
			userid.focus();
			timeOutCall();
			return false;
		}
		
		//ID 유효성 검사
		var regIDPattern = /^[a-zA-Z0-9]+$/;
		if(regIDPattern.test(userid.val())) {
			console.log('the value of pw is good');
		} else {
			valueError.text('ID는 영어, 숫자로만 입력하세요.');
			userid.focus();
			return false;
		}
	
		//비밀번호 유효성 검사
		if(userpw.val().length >= 8) {
			console.log('the value of pw is good');
		} else {
			valueError.text('비밀번호를 8자 이상 입력하세요.');
			userpw.focus();
			return false;
		}

		return true;

		//타임아웃 함수
		function timeOutCall() {
			setTimeout(function() {
				$('#valueError').text('');
			},2000);
		}
	});
});