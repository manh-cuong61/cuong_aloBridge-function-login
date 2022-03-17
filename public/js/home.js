let pic = document.querySelector("#picture")
let btnDel = document.querySelectorAll(".button-delete");
let el = document.querySelectorAll("el-product");
let page = new URLSearchParams(window.location.search).get('page') ?? 1 //default page
let header = document.querySelector(".content .header");
let table = document.querySelector(".table")

function readURL(input) {
    if (input.files[0]) {
        var reader = new FileReader();
        reader.onload = function () {
            pic.setAttribute('src', reader.result);  
        };

        reader.readAsDataURL(input.files[0]);
    }
}

//delete
for(let i = 0; i < btnDel.length; i++) {
    btnDel[i].addEventListener("click", function(event){
    
        result =  confirm('Do you want to delete?')
        if(!result){
           return event.preventDefault()
        }
        table.remove();

        xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
            code =  JSON.parse(xhttp.responseText).code;

            if(code == 200) {
                data = JSON.parse(xhttp.responseText).data;
                //create table with new data
                newTable = "<table class= 'table'> <tr class='tr1'><th id='th1'>#</th><th>Name</th><th>Giá</th><th>Tags</th><th class='image'>Image</th><th>DELETE</th><th>EDIT</th></tr>"
                data.forEach(element => {
                    tags = '';
                    element.tags.forEach(val => {    
                        tags += "<span>"
                        tags += val['name']
                        tags += "</span>"                       
                    })
                    newTable += "<tr id='el-" 
                    + element.product_id+"'><td id='td1'>" 
                    +  element.product_id + "</td><td>" + element.product_name 
                    + "</td><td>" + element.price 
                    + "</td><td class='tag'>" + tags + "</td></td><td> <img src='/aloBridge-function-login/public/img/" 
                    + element.image + "' alt=''> </td><td><a class= 'button-delete' href='' id='" 
                    + element.product_id 
                    + "'>DELETE</a></td><td><a class= 'button-edit' href=''>EDIT</a></td></tr>"
                });
                newTable += "</table>"
                //insert html 
                header.insertAdjacentHTML("afterend", newTable)

                toastr.success('Success')
            }else {
                toastr.error('error')
            }
            
        }
          
          // Send a request
          xhttp.open("DELETE", "http://localhost:8082/aloBridge-function-login/public/product/" + this.id + "?page=" + page, true);
          xhttp.send();
    });
};