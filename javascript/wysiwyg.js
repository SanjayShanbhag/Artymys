 function iFrameOn(){
 		richTextField.document.designMode = "On";
 		document.getElementById('richTextField').contentWindow.document.body.style.color='#616161';
 		document.getElementById('richTextField').contentWindow.document.body.style.fontSize='medium';
 		document.getElementById('richTextField').contentWindow.document.body.style.lineHeight='3';
 }
 function iBold(){
 	richTextField.document.execCommand('bold',false,null);
 }
 function iUnderline(){
 	richTextField.document.execCommand('underline',false,null);
 }
 function iItalic(){
 	richTextField.document.execCommand('italic',false,null);
 }
 function iFontSize(){
 	var size = prompt('Enter a Size 1-7', '');
 	richTextField.document.execCommand('FontSize',false,size);
 }
 function iUnorderedList(){
 	richTextField.document.execCommand('InsertUnorderedList',false,"newUL");
 }
 function iOrderedList(){
 	richTextField.document.execCommand('InsertOrderedList',false,"newOL");
 }
 function iHorizontalRule(){
 	richTextField.document.execCommand('insertHorizontalRule',false,null);
 }
 function iLink(){
 	var linkURL = prompt("Enter the URL for this Link:","http://");
 	richTextField.document.execCommand('CreateLink',false,linkURL);
 }
 function iUnlink(){
 	richTextField.document.execCommand('Unlink',false,null);
 }
 function submit_form(){
 	var theForm = document.getElementById("myform");
 	theForm.elements["content"].value = window.frames['richTextField'].document.body.innerHTML;
 	theForm.submit();
 }