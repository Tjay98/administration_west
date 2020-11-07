<div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <h3 class="text-center">REGISTO</h3>
            <form class="form-signin">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" class="form-control-custom" placeholder="Email address" required autofocus>
                <input type="password" id="inputPassword" class="form-control-custom" placeholder="Password" required>
                <input type="password" id="inputRepetirPassword" class="form-control-custom" placeholder="Repetir Password" required>

                <button class="btn btn-lg btn-primary btn-block btn-signin mt-4" type="submit">Sign Up</button>
            </form><!-- /form -->
            <p>Have an account<a href="<?php echo base_url('clients/login'); ?>" class="forgot-password">
             Sign In</a></p>
        </div><!-- /card-container -->
    </div><!-- /container -->