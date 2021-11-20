{include file='templates/main/header.tpl'}
<h5 class="text-center made-by-juani display-7">made by <span class="text-warning">Juani</span></h5>
<section>
  <div class="mask d-flex align-items-center h-100 gradient-custom-3 m-4">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100 my-1">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-center mb-5 text-dark">Login to your account</h2>

              <form action="verifylogin" method="post">

                <div class="form-outline mb-4">
                  {if $email}
                    <input type="email" id="form3Example3cg" class="form-control form-control-lg" name="email" value={$email} required/>
                  {else}
                    <input type="email" id="form3Example3cg" class="form-control form-control-lg" name="email" required/>
                  {/if}
                  <label class="form-label mt-2" for="form3Example3cg">Your Email</label>
                </div>

                <div class="form-outline mb-4">
                  {if $password}
                    <input type="password" id="form3Example4cg" class="form-control form-control-lg" name="password" value={$password} required/>
                  {else} 
                    <input type="password" id="form3Example4cg" class="form-control form-control-lg" name="password" required/>
                  {/if}
                  <label class="form-label mt-2" for="form3Example4cg">Password</label>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="submit" class="btn btn-info text-white btn-block btn-lg gradient-custom-4  text-white">Login</button>
                </div>
                {if $UserFail}
                  <div>
                    <p class="alert alert-warning text-center mt-3">email is not registered</p>
                  </div>
                {/if}
                {if $PasswordFail}
                  <div>
                    <p class="alert alert-warning text-center mt-3">invalid password</p>
                  </div>
                {/if}
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
{include file='templates/main/footer.tpl'}