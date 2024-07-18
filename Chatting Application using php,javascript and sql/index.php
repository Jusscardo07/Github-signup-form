
<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Realtime Chat App </header>
            <form action="#" enctype="multipart/form-data"> 
                <div class="error-text"></div>
                <div class="name-details">
                    <div class="field input">
                        <label >Firstname</label>
                        <input type="text"  name="fname"  placeholder="First name" required>

                    </div>
                    <div class="field input">
                        <label >Lastname</label>
                        <input type="text" name="lname" placeholder="Last name"required>
            
                    </div>
                </div>
                    <div class="field input">
                        <label >Email Address</label>
                        <input type="email" name="email"  placeholder="Enter your email address" required>
                        
                    </div>
                    <div class="field input">
                        <label >Password</label>
                        <input type="password" name="password"  placeholder="Enter  Password" required>
                        <i class='bx bxs-hide'></i>
                        
                    </div>
                    <div class="field image">
                        <label >Select Image</label>
                        <input type="file" name="image" required>
                        
                    </div>
                    <div class="field button">
                        <input type="submit" value="Continue to chat">

                      <div class="class-link">Already have an Account <a href="login.php">Login now</a></div>
                            
                        </div>
                        
                </div>
            </form>
        </section>
       
    </div>
    <script src="javaScript/pass-show-hide.js"></script>
    <script src="javaScript/signup.js"></script>
</body>

</html>