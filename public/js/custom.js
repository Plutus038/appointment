 var baseURL = $('body').data('baseurl');


function approveRequest(appointment_id)
{
     if(confirm('Are you sure, you want to accept this appointment request?')){
         $.ajax({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             type: 'PUT',
             url: baseURL+'/appointment/'+appointment_id+'/ACCEPTED',
             success: function(data){
                 if(data == 'succ'){
                     location.reload(true);
                 }
             },
             error: function (data) {
                 if(data.status == 422){
                     var response = JSON.parse(data.responseText);
                     alert(response.data);
                 }
                 console.log('Error:', JSON.parse(data.responseText));
             }
         });
     }
 }

 function submit(){
     $("#appointment").submit();
 }
