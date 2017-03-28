<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{config('APP_NAME','用户注册')}}</title>
</head>
<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<body>

   <div class="container-fluid">
       
       <div class="row">
           
           <div class="col-lg-offset-3 col-lg-6">
               
               <!-- 用户注册表单 -->
               <form method="POST" action="{{url('user')}}" accept-charset="UTF-8" role="form">
                  {{ csrf_field() }}
                    <!-- name -->
                     <div class="form-group">
                        <label for="name">name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="">
                     </div>
                   <!-- password -->
                   <div class="form-group">
                       <label for="password">password</label>
                       <input type="password"  name="password" class="form-control" id="password" placeholder="Password">
                     </div>
                       <!-- email -->
                        <div class="form-group">
                           <label for="email">email</label>
                           <input type="email" name="email" class="form-control" id="email" placeholder="">
                        </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-default" value="用户名称">
                    </div>
               </form>
           </div>
       </div>
   </div>
</body>
</html>
