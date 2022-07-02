if(document.getElementsByClassName('sto_view')[0]){
    var tx = document.getElementsByClassName('sto_view')[0];
    var gox = tx.innerHTML;
    var qa = [gox];
tx.onclick = function(e){
if((window.innerWidth/2) > e.clientX){
    console.log('ls');
var d = document.getElementsByClassName('so_lo_po')[0];
for(var i =0; i < d.children.length; i++){
    if(d.children[i].style.display == 'block'){
        d.children[i].style.display = 'none';
        var t =(d.children[i].id).substring(2);
        if(document.getElementById('ox'+parseInt(t)-1)){
            document.getElementById('ox'+parseInt(t)-1).style.display = 'block';
        }
        else {
            document.getElementsByClassName('sto_view')[0].innerHTML = qa[0];
            document.getElementsByClassName('sto_view')[0].style.display = 'none';
        }
    } 
}
}
else {
    console.log('rs');
var d = document.getElementsByClassName('so_lo_po')[0];
for(var i =0; i < d.children.length; i++){
    if(d.children[i].style.display == 'block'){
        d.children[i].style.display = 'none';
        var t =(d.children[i].id).substring(2);
        console.log(document.getElementById('ox'+parseInt(t)+1), parseInt(t)+1)
        if(document.getElementById('ox'+parseInt(t)+1)){
            console.log('yes2');
            document.getElementById('ox'+parseInt(t)+1).style.display = 'block';
        }
        else {
            document.getElementsByClassName('sto_view')[0].innerHTML = qa[0];
            document.getElementsByClassName('sto_view')[0].style.display = 'none';
        }
    } 
}
}
}
}