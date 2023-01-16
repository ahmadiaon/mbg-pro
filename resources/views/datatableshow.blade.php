<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
    <input type="text" name="" id="head" value="as">
    <table class="table table-sm">
        <thead>
          <tr id="theads">
           
          </tr>
        </thead>
        <tbody id="t_body">
         
         
        </tbody>
      </table>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script>
        let data = @json($data);
        if(typeof data === 'object'){
          var satu = data[Object.keys(data)[0]];
        }else{
          let satu = data[0];
        }
        
        // satu.findIndex(function (entry, i) {
        //     console.log(entry);
        // });
        let arr_index = [];
        let t_head ='<th scope="col">No</th>';
        console.log(satu);
        for (var key in satu) {
          arr_index.push(key);
            t_head = t_head+`<th scope="col">${key}</th>`;
            console.log(key + ' is ' + satu[key]);
        }
        
        console.log(arr_index);
        var elements ='';

        $('#theads').append(t_head);
        let z=1;
     

        if(typeof data === 'object'){
          Object.keys(data).forEach(element => {
            console.log(data[element]);
            elements = ``;
            elements = ` <tr><td>${z}</td>`;
            for (var key in satu) {
                elements = elements +`<td>${data[element][key]}</td>`;
            }
            elements = elements + ` </tr>`;
            z++;
            $('#t_body').append(elements);
          });
        }else{
          data.forEach(element => {
            elements = ``;
            elements = ` <tr><td>${z}</td>`;
            for (var key in element) {
                elements = elements +`<td>${element[key]}</td>`;
            }
            elements = elements + ` </tr>`;
            z++;
            $('#t_body').append(elements);
            
          });
          
        }
        $('#head').val(z)

    </script>
  </body>
</html>