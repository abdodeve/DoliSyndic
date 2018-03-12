//Store Api Server Url as Parameter
localStorage.apiServer = "https://gestion-tva.marocgeek.com";
console.log(localStorage.token);

$( document ).ready(function() {
        
       // Login API 
       $('form[id="login"] input[type="submit"]').click(function( event ) {
          
            var ajaxUrl        = localStorage.apiServer+'/htdocs/syndic/framework/public/api/userLogin' ;
            var login_typed    = $('form[id="login"] input[id="username"]').val() ;
            var password_typed = $('form[id="login"] input[id="password"]').val() ;
            $.ajax({
                      async       : false,
                      method  		: 'POST',
                      url     		: ajaxUrl,
                      data    		: {login:login_typed,password:password_typed},
                      success 		: function(response) {
                                                          localStorage.token = response.success.token ;
                                                   },
                      error				: function(data){
                                                           console.log('Error Credentials can not get token login/password');
                                                  }
                });
         });
  
  //Log out - API REQUEST
  $('.login_block_elem a').click(function( event ) {
      var ajaxUrl        = localStorage.apiServer+'/htdocs/syndic/framework/public/api/userLogout' ;
			var token          = localStorage.token;
    $.ajax({
             // async       : false,
              method  		: 'POST',
              url     		: ajaxUrl,
              headers     : {
                                'Accept'        :'application/json',
                                'Authorization' :'Bearer '+token
                            },
              success 		: function(response){
                                                  localStorage.token = null ;
                                                  console.log('log out done !');
                                           },
              error				: function(data){
                                                   console.log('Invalid Token');
                                          }
        });
  });
     
});