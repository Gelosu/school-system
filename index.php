<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/kld.logo.png">
    <title>Kolehiyo ng Dasmariñas</title>
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="style.css">
    <script>
        // Function to set and activate the desired section based on navigation clicks
        function setActiveSection(sectionId) {
            window.location.hash = sectionId;  
            toggleSection(sectionId); // Toggle visibility of the selected section
        }

        // Function to toggle visibility of sections
        function toggleSection(sectionId) {
            var sections = document.querySelectorAll('.section');
            sections.forEach(function(section) {
                if (section.id === sectionId) {
                    section.style.display = 'block'; // Show the active section
                } else {
                    section.style.display = 'none'; // Hide other sections
                }
            });
        }

        // Show default section (e.g., HOME) when page loads
        document.addEventListener('DOMContentLoaded', function () {
            toggleSection('home');
        });
    </script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="assets/img/kld.logo.png" alt="Logo"> 
            <span>KOLEHIYO NG DASMARINAS</span>
        </div>
        <nav>
            <a href="#" onclick="setActiveSection('home')">HOME</a>
            <a href="#" onclick="setActiveSection('about')">ABOUT</a>
            <div class="dropdown">
                <a href="#">UNITS</a>
                <div class="dropdown-content">
                    <a href="login.php" onclick="setActiveSection('guidance')">GUIDANCE SERVICES AND CAREER DEVELOPMENT</a>
                    <a href="login.php" onclick="setActiveSection('welfare')">CHARACTER FORMATION AND WELFARE DEVELOPMENT</a>
                    <a href="login.php" onclick="setActiveSection('studacts')">STUDENT ACTIVITIES AND DEVELOPMENT</a>
                    <a href="login.php" onclick="setActiveSection('sports')">SPORTS AND WELLNESS DEVELOPMENT</a>
                    <a href="#" onclick="setActiveSection('studpubs')">STUDENT PUBLICATIONS</a>
                    
                </div>
            </div>
            <a href="#" onclick="setActiveSection('contacts')">CONTACTS</a>
            <a href="login.php"onclick="setActiveSection('login')">LOGIN</a>
           
            
        </nav>
    </header>

    

    <!-- Section Content -->
    <div id="home" class="section">
    <div class="main-content">
        <div class="content-wrapper">
            <img src="Isaceclogo.png" alt="ISACEC Logo" class="image">
            <div class="text">
                <h1>ISACEC</h1>
                <h3>Institute of Student Affairs, Character Education, and Citizenship</h3>
            </div>
        </div>
    </div>
</div>


    <div id="about" class="section" style="display: none;">
    <div class="about-container">
        <h2 class="about-title">About ISACEC</h2>
        <p class="about-introduction">
            The Institute of Student Affairs, Character Education, and Citizenship (ISACEC) is a vital part of the academic services offered at Kolehiyo ng Lungsod ng Dasmariñas (KLD). Committed to the holistic development of students, ISACEC goes beyond academics to foster growth in extracurricular activities, character formation, and citizenship.
        </p>
        <p class="about-introduction">
            At ISACEC, students are empowered to enhance their abilities and skills across diverse areas, ensuring a well-rounded college experience.
        </p>

        <div class="about-units">
            <div class="unit">
                <h3 class="unit-title">Student Character Formation and Welfare Development</h3>
                <p>This unit focuses on nurturing character and ensuring student welfare. It promotes discipline, ethical behavior, and personal growth, equipping students with the necessary tools to succeed in both their academic and personal lives.</p>
            </div>
            <div class="unit">
                <h3 class="unit-title">Sports and Wellness Development</h3>
                <p>Dedicated to promoting physical fitness and sportsmanship, this unit organizes various sports programs and wellness activities to encourage a balanced lifestyle among students.</p>
            </div>
            <div class="unit">
                <h3 class="unit-title">Student Publication</h3>
                <p>Managing KLD’s official journalism group, Los Sueños, this unit captures and reports on events within the school, providing students with opportunities to develop their writing, editing, and reporting skills.</p>
            </div>
            <div class="unit">
                <h3 class="unit-title">Student Activities and Development</h3>
                <p>This unit oversees student organizations and activities, supports the establishment of new groups, and facilitates candidacy for the student council, fostering leadership and organizational skills.</p>
            </div>
            <div class="unit">
                <h3 class="unit-title">Guidance Services and Career Development</h3>
                <p>Focused on mental health and personal growth, this unit provides counseling services to address academic and personal concerns, helping students navigate challenges and prepare for their futures.</p>
            </div>
        </div>
    </div>
</div>

<div id="contacts" class="section" style="display: none;">
    <div class="contacts-container">
        <h2 class="contacts-title">CONTACTS & EMAIL</h2>
        

        <div class="contact-units">
            <div class="unit">
                <h3 class="unit-title">Geordan L. Carungcong

</h3>
<p>Dean, Institute of Student Affairs, Character Education, and Citizenship
</p>
<p>glcarungcong@kld.edu.ph</p>
</div>
<div class="unit">
<h3 class="unit-title">Lou Sandino L. Castro

</h3>
<p>Head, Students’ Character Formation and Welfare Development
</p>
<p>lslcastro@kld.edu.ph</p>
</div>
<div class="unit">
<h3 class="unit-title">Jet Martine S. Geronimo

</h3>
<p>Head, Student Activities, and Development
</p>
<p>jmsgeronimo@kld.edu.ph</p>
</div>
<div class="unit">
<h3 class="unit-title">Oscar P. Bucad Jr.

</h3>
<p>Coordinator, Sports and Wellness Development
</p>
<p>obucad@kld.edu.ph</p>
</div>
<div class="unit">
<h3 class="unit-title">Mary Ellain A. Estil

</h3>
<p>Coordinator, Student Publication
</p>
<p>meae@kld.edu.ph</p>
</div>
<div class="unit">
<h3 class="unit-title">Ma. Fatima B. Estacion

</h3>
<p>Head, Guidance Services and Career Development Unit
</p>
<p>mfestacion@kld.edu.ph</p>
</div>
        </div>
    </div>
</div>

  

    <div id="studpubs" class="section" style="display: none;">
    <?php include 'STUDPUBS/studpubs.php'; ?>
    </div>

    
</body>
</html>

