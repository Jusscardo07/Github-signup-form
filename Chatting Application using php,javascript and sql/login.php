
<?php include_once "header.php";?>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>Realtime Chat App </header>
            <form action="#">
                <div class="error-text"></div>
                
                    <div class="field input">
                        <label >Email Address</label>
                        <input type="email" name="email" placeholder="enter your email address" required>
                        
                    </div>
                    <div class="field input">
                        <label >Password</label>   
                        <input type="password" name="password" placeholder="Enter your Password" required>
                        <i class='bx bxs-hide'></i>
                    </div>
                    
                    <div class="field button">
                        <input type="submit" value="Continue to chat">

                      <div class="class-link">Don't have an Account <a href="index.php">Signup now</a></div>
                            
                        </div>
                        
                   
                </div>
            </form>
        </section>
       
    </div>
    <script src="javaScript/pass-show-hide.js"></script>
    <script src="javaScript/login.js"></script>
</body>
</html>