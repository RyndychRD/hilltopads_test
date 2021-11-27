<h1>Blacklist::save</h1>  
Для вызова Blacklist::save необходимо отправить POST запрос по адресу  
localhost:8000/api/blacklist  
с телом JSON вида  
{  
"input_line": "{input_line}",  
"advertiser_id": {advertiser_id}  
}  
После этого придет ответ вида  
{"status":"error","error_type":2,"error-message":"Invalid input line format."}  
при возникновении ошибки и  
{"status":"Success"}  
при успешном выполнении  
  
<h3>Примеры Blacklist::save </h3> 
<h5>1</h5>
Входной JSON:{
"input_line": "s8, s2",
"advertiser_id": 5
}  
Выходной JSON:{"status":"Success"}

<h5>2</h5>
Входной JSON:{
"input_line": "s8, s2",
"advertiser_id": 500
}  
Выходной JSON:{"status":"error","error_type":1,"error_message":"Advertiser does not exists.Requested id:500"}
<h5>3</h5>
Входной JSON:{
"input_line": "p8, s200",
"advertiser_id": 5
}  
Выходной JSON:{"status":"error","error_type":3,"error-message":"Site does not exist. Requested id:200"}


<h1>Blacklist::get</h1>
Для вызова Blacklist::get необходимо отправить GET запрос по адресу  
localhost:8000/api/blacklist/{id} 
После этого придет ответ вида  
{"status":"error","error_type":1,"error_message":"Advertiser does not exists.Requested id:50"}  
при возникновении ошибки и  
{"status":"Success","message":"s9, s3, s8, s2, p2, p4"} 
при успешном выполнении

<h3>Примеры Blacklist::get</h3>
<h5>1</h5>
Входной url:localhost:8000/api/blacklist/500  
Выходной JSON:{"status":"error","error_type":1,"error_message":"Advertiser does not exists.Requested id:500"}

<h5>2</h5>
Входной url:localhost:8000/api/blacklist/5 
Выходной JSON:{"status":"Success","message":"s9, s3, s8, s2, p2, p4, p8"}

<h5>3</h5>
Входной url:localhost:8000/api/blacklist/3
Выходной JSON:{"status":"Success","message":""}
  
<h2>P.S.</h2>
При каждом запуске тестов база пересидируется новыми случайными значениями
Ответы можно получить с помощью Postman или его аналога  
