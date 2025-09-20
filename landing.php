<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/391827d54c.js" crossorigin="anonymous"></script>
    <!-- <link rel="shortcut icon" href="./Assets/favicon.png" type="image/x-icon"> -->
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@500;700;800&display=swap");

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background-color: #000;
    color: #fff;
}

.header {
    width: 100%;
    height: 100vh;
    position: relative;
    overflow: hidden;
}

nav {
    display: flex;
    align-items: center;
    justify-content: flex-end; /* Align buttons to the right */
    padding: 10px 8%;
    position: relative;
    z-index: 10; /* Ensure nav appears above video */
}

nav button {
    border: none;
    outline: none;
    background-color: #db0001;
    color: #fff;
    padding: 7px 20px;
    font-size: 12px;
    border-radius: 4px;
    cursor: pointer;
}

.background-video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover; /* Cover the entire container */
    z-index: 1; /* Ensure it stays behind the content */
}
nav button {
    border: none;
    outline: none;
    background-color: #db0001;
    color: #fff;
    padding: 7px 20px;
    font-size: 12px;
    border-radius: 4px;
    margin-left: 10px;
    cursor: pointer;
}

.lang-btn {
    display: inline-flex;
    align-items: center;
    background: transparent;
    border: 1px solid #fff;
    padding: 7px 10px;
}

.lang-btn img {
    width: 10px;
    margin-left: 10px;
} 

.fa-globe {
    color: #fff;
    width: 10px;
    margin-right: 10px;
}

.header-content {
    position: relative;
    z-index: 10; /* Ensure content appears above the video */
    text-align: center;
    color: #fff;
    top: 50%;
    transform: translateY(-50%); /* Center vertically */
    padding: 0 20px; /* Add some padding for smaller screens */
}

.header-content h1 {
    font-size: 3rem;
    margin-bottom: 10px;
}

.header-content h3 {
    font-size: 1.5rem;
    margin-bottom: 20px;
}

.header-content p {
    font-size: 1rem;
}

.email-signup {
    background: #fff;
    border-radius: 4px;
    display: flex;
    align-items: center;
    margin-top: 30px;
    overflow: hidden;
}

.email-signup input {
    flex: 1;
    border: 0;
    outline: 0;
    margin-left: 20px;
}

.email-signup button {
    background-color: #db0001;
    border: none;
    outline: none;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    padding: 15px 30px;
}


.features {
    padding: 50px 12%;
    font-size: 22px;
}

.row {
    display: flex;
    align-items: center;
    width: 100%;
    flex-wrap: wrap;
    padding: 50px 0;
}

.text-col, .img-col {
    flex-basis: 50%;
    margin-bottom: 20px;
}

.img-col img {
    display: block;
    width: 90%;
    margin: auto;
}

.features h2 {
    font-size: 50px;
    font-weight: 600;
    margin-bottom: 20px;
}

.faq {
    padding: 10px 12%;
    text-align: center;
    font-size: 18px;
}

.faq h2 {
    font-size: 40px;
    font-weight: 500;
}

.accordion {
    margin: 60px auto;
    width: 100%;
    max-width: 750px;
}

.accordion li {
    list-style: none;
    width: 100%;
    padding: 5px;
}

.accordion li label {
    display: flex;
    align-items: center;
    padding: 20px;
    font-size: 18px;
    font-weight: 500;
    background-color: #303030;
    margin-bottom: 2px;
    cursor: pointer;
    position: relative;
}

label::after {
    content: '+';
    font-size: 34px;
    position: absolute;
    right: 20px;
    transition: transform 0.5s;
}

input[type="radio"] {
    display: none;
}

.accordion .content {
    background-color: #303030;
    text-align: left;
    padding: 0 20px;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.5s, padding 0.5s;
}

.accordion input[type="radio"]:checked + label + .content {
    max-height: 600px;
    padding: 30px 20px;
}

.accordion input[type="radio"]:checked + label::after {
    transform: rotate(135deg);
}

.faq small {
    font-size: 13px;
}

.faq .email-signup {
    max-width: 600px;
    margin: 20px auto 60px;
}


.footer {
    padding: 50px 15% 10px;
    border-top: 6px solid #333;
    color: #777;
}

.footer h2 {
    font-size: 18px;
    font-weight: 400;
    margin-bottom: 30px;
}

.footer .col {
    flex-basis: 25%;
    flex-grow: 1;
    margin-bottom: 20px;
}

.footer .col a {
    display: block;
    color: #777;
    font-size: 14px;
    margin-bottom: 10px;
    text-decoration: none;
}

.footer .row {
    align-items: flex-start;
    padding: 10px 0px;
}

.footer .lang-btn {
    color: #fff;
    padding: 10px 20px;
    border-radius: 3px;
}

.copyright-text {
    font-size: 14px;
    margin-top: 20px;
    margin-bottom: 10px;
}



@media only screen and (max-width: 600px) {
    .logo {
        width: 100px;
    }

    nav button {
        padding: 5px 10px;
    }

    nav .lang-btn {
        padding: 4px 8px;
    }

    .header-content {
        position: unset;
        transform: none;
        padding-top: 150px;
    }

    .header-content h1 {
        font-size: 30px;
    }

    .email-signup button {
        font-size: 12px;
        padding: 10px 15px;
    }

    .text-col, .img-col {
        flex-basis: 100%;
    }
    

    .features h2 {
        font-size: 30px;
    }

    .features p {
        font-size: 15px;
    }

    .row:nth-child(2), .row:nth-child(4) {
        flex-direction: column-reverse;
    }

    .features .row {
        padding: 10px 0;
    }

    .faq h2 {
        font-size: 20px;
    }

    .accordion .content {
        font-size: 14px;
    }

    .accordion li label {
        padding: 10px;
        font-size: 14px;
    }

    label::after {
        font-size: 22px;
    }
}
    </style>
    <title>ashirvad productions - Book TV Shows Online, Movies Rights Online</title>
</head>
<body>
<div class="header">
    <nav>
        <div>
            <button onclick="location.href='cusreglog.php';">Sign In</button>
        </div>
    </nav>

    <!-- Video background -->
    <video class="background-video" autoplay muted loop>
        <source src="./images//landing.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Header Content -->
    <div class="header-content">
        <h1>Welcome to Ashirvad Production.</h1>
        <h3>Book anywhere. Cancel anytime.</h3>
        <p>Register to create your membership.</p>
    </div>
</div>

    <div class="features">
        <div class="row">
            <div class="text-col">
                <h2>Movie distribution.</h2>
                <p>Distributors license films to theaters granting the right to show the film for a theatrical rental rental fee..</p>
            </div>
            <div class="img-col">
                <img src="./images/nunakuzhi - Copy.jpg" alt="feature-1">
            </div>
        </div>
        <div class="row">
            <div class="img-col">
                <img src="./images/walalal - Copy.jpg" alt="feature-2">
            </div>
            <div class="text-col">
                <h2>movie rights</h2>
                <p>the legal permissions granted to a person or entity to adapt a literary work, such as a book, into a film</p>
            </div>
        </div>
        <div class="row">
            <div class="text-col">
                <h2>satelliet</h2>
                <p>In the Indian movie industry, satellite rights refer to the permission granted by a movie producer to a television channel or network to air their film on TV</p>
            </div>
            <div class="img-col">
                <img src="./images/premalu - Copy.png" alt="feature-3">
            </div>
        </div>
        <div class="row">
            <div class="img-col">
                <img src="./images/aadujeevitham - Copy.jpg" alt="feature-4">
            </div>
            <div class="text-col">
                <h2>Create profiles for children.</h2>
                <p>Send children on adventures with their favourite characters in a space made just for them—free with your membership.</p>
            </div>
        </div>
    </div>


  
    <div class="faq">
        <h2>Frequently Asked Questions</h2>

        <ul class="accordion">
            <li>
                <input type="radio" name="accordion" id="first">
                <label for="first">What is ashirvad production?</label>
                <div class="content">
                    <p>ashirvad is a rights service that offers a wide variety of award-winning TV shows, movies, anime, documentaries and more – on thousands of internet-connected devices.<br><br>
                    You can watch as much as you want, whenever you want, without a single ad – all for one low monthly price. There's always something new to discover, and new TV shows and movies are added every week!</p>
                </div>
            </li>
            <li>
                <input type="radio" name="accordion" id="second">
                <label for="second">How much does movies cost?</label>
                <div class="content">
                    <p>book movies on your smartphone, tablet, Smart TV, laptop, or streaming device, all for one fixed monthly fee. Plans range from ₹ 149 to ₹ 649 a month. No extra costs, no contracts.</p>
                </div>
            </li>
            <li>
                <input type="radio" name="accordion" id="third">
                <label for="third">Where can I watch?</label>
                <div class="content">
                    <p>Watch anywhere, anytime. Sign in with your  account to watch instantly on the web at  from your personal computer or on any internet-connected device that offers the Netflix app, including smart TVs, smartphones, tablets, streaming media players and game consoles.<br><br>
                    You can also download your favourite shows with the iOS, Android, or Windows 10 app. Use downloads to watch while you're on the go and without an internet connection. Take Netflix with you anywhere.</p>
                </div>
            </li>
            <li>
                <input type="radio" name="accordion" id="fourth">
                <label for="fourth">How do I cancel?</label>
                <div class="content">
                    <p>it is flexible. There are no annoying contracts and no commitments. You can easily cancel your account online in two clicks. There are no cancellation fees – start or stop your account anytime.</p>
                </div>
            </li>
            <li>
                <input type="radio" name="accordion" id="fifth">
                <label for="fifth">What can I watch on ashirvad production?</label>
                <div class="content">
                    <p>it has an extensive library of feature films, documentaries, TV shows, anime, award-winning Netflix originals, and more. Watch as much as you want, anytime you want.</p>
                </div>
            </li>
            
        </ul>
        
        <small>Ready to book? register to create or restart your membership.
        </small>
        
        <form action="#" class="email-signup">
            
        </form>  
    </div>

    <div class="footer">
        <h2>Questions? Call 000-000-000-0000</h2>

        <div class="row">
            <div class="col">
                <a href="#">FAQ</a>
                <a href="#">Investor Relations</a>
                <a href="#">Privacy</a>
                <a href="#">Speed Test</a>
            </div>
            <div class="col">
                <a href="#">Help Centre</a>
                <a href="#">Jobs</a>
                <a href="#">Cookie Preferences</a>
                <a href="#">Legal Notices</a>
            </div>
            <div class="col">
                <a href="#">Account</a>
                <a href="#">Ways to Watch</a>
                <a href="#">Corporate Information</a>
                <a href="#">Only on Netflix</a>
            </div>
            <div class="col">
                <a href="#">Media Centre</a>
                <a href="#">Terms of Use</a>
                <a href="#">Contact Us</a>
            </div>
        </div>

        <button onclick="location.href='cusreglog.php';">Sign In</button>

        <p class="copyright-text">Netflix India</p>
    </div>

</body>
</html>