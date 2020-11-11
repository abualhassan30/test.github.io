



<br>
<br>
<div class="container">


    <div class="card" style="max-width:500px;margin: auto;">
        <div class="card-header">
            تسجيل الدخول
        </div>
        <div class="card-body">




            <form action="login.php?switch=login" method="post"  >



                <div>
<!--                    <label   for="pwd">نوع المستخدم:</label>
                    <select name="group_id" class="form-control">
                        <option value='2'>وكيل</option>
                        <option value='1'>رئيس قسم</option>

                    </select>  --> 

                    <label  for="usr">اسم المستخدم :</label >
                    <input type="text" name="login_id" class="form-control"  id="usr">


                    <label   for="pwd"> كلمة المرور:</label>
                    <input type="password" name="login_password" class="form-control"  id="pwd">


                    <hr>




                    <div>
                        <button type="submit" class="btn btn-success" >تسجيل دخول </button>
                        <a href="forgot.php" class="btn btn-info" >فقدت كلمة المرور</a>
                        <!--<button type="submit" class="btn btn-info" >التسجيل</button>  -->
                    </div>

                </div>


            </form>

        </div>
    </div>
</div>

