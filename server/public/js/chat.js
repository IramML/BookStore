var btnSend=document.getElementById("btn-send");
var iMessage=document.getElementById("i-message");

btnSend.onclick=sendMessage;
setInterval(function(){
    getMessagesFromIndex();
}, 4000);

function getMessagesFromIndex(){
    var xmlhttp = new XMLHttpRequest();
    var formData=new FormData();
    formData.append("chat_id", chatID);
    formData.append("index", messageIndex);
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == XMLHttpRequest.DONE) {
            if (xmlhttp.status == 200) {
                var responseObject=JSON.parse(xmlhttp.responseText);
                if(responseObject.code=="200"){
                    responseObject.messages.forEach(message => {
                        var txtMessage=message.content;
                        var direction="";
                        if(message.is_file=="1"){
                            if(message.is_client=="0")
                                txtMessage=`<a style="color: #ffffff; text-decoration: underline;" target="_blank" href="${uploadsURL}messages/files/${message.content}">Archivo</a>`;
                            else
                                txtMessage=`<a style="color: #212121; text-decoration: underline;"  target="_blank" href="${uploadsURL}messages/files/${message.content}">Archivo</a>`;
                        }
                        if(message.is_client=="0"){
                            direction="right";
                            console.log(message.is_client);
                        }
                        let chatMessage=`
                        <div class="direct-chat-msg ${direction}">
                              <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-left"></span>
                                <span class="direct-chat-timestamp float-right"> ${message.timestamp}</span>
                              </div>
                              <!-- /.direct-chat-infos -->
                              <div class="direct-chat-text">
                                ${txtMessage}
                              </div>
                              <!-- /.direct-chat-text -->
                            </div>
                        `;
                        document.getElementById("messages-container").innerHTML+=chatMessage;
                        messageIndex=message.id;
                    });
                  
                   
                }
            }
            else if (xmlhttp.status == 400) {
                alert('There was an error 400');
            }
            else {
                alert('something else other than 200 was returned');
            }
        }
    };
    
    xmlhttp.open("POST", "../getMessageByIndex", true);
    xmlhttp.send(formData);
}

function sendMessage(){
    if(iMessage.value!=""){
        var txtMessage=iMessage.value;
        iMessage.value="";
        var xmlhttp = new XMLHttpRequest();
        var formData=new FormData();
        formData.append("chat_id", chatID);
        formData.append("message", txtMessage);
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == XMLHttpRequest.DONE) {
                if (xmlhttp.status == 200) {
                    console.log(xmlhttp.responseText);
                }
                else if (xmlhttp.status == 400) {
                    alert('There was an error 400');
                }
                else {
                    alert('something else other than 200 was returned');
                }
            }
        };
        
        xmlhttp.open("POST", "../sendMessage", true);
        xmlhttp.send(formData);
    }
}
