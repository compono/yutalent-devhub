// JavaScript Document


// javascript for character check and credit deduction
function countChar(val) {					
        var tlen = val.value.length;
		if(tlen > 459)
		{
			var text = $('textarea').val();
			var subst = text.substring(0,459);
			alert('Text message length could not exceed 459 character');
			$('textarea').val(subst);			
		}
		var len = val.value.length;
		if(len > 160)
		{
		var div = len / 153;
		}else if(len <= 160)
		{
		var div = 1;
		}		
		var no = Math.ceil(div);
		//$('#cred_count').val(no);
		$('#char_count').text('This will use '+no+' credit!');
      };