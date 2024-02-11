//here r is response
// the second "then" catches the response from first "then" and stores it

// READ MESSAGES FROM THE DATABASE
let msgdiv=document.querySelector(".msg");

// Reads and displays msgs in 0.5 sec
setInterval(()=>{
    fetch("readMsg.php").then(
        r=>{
            if(r.ok){
                return r.text();
            }
        }
    ).then(
        d=>{
            msgdiv.innerHTML=d;
        }
    )
},500);

// ADD MESSAGES TO DATABASE
// if anyone writes in text-box and press Enter button
window.onkeydown=(e)=>{
    if(e.key=="Enter"){
        update()
    }
}
// Functionality of update function
function update(){
    let msg=input_msg.value;
    input_msg.value="";
    fetch(`addMsg.php?msg=${msg}`).then(
        r=>{
            if(r.ok){
                return r.text();
            }
        }
    ).then(
        d=>{
            console.log("msg has been added")
            msgdiv.scrollTop=(msgdiv.scrollHeight-msgdiv.clientHeight);
            
        } 
    )
}