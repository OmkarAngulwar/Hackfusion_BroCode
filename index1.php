<?php
    session_start();
    if(!isset($_SESSION['username']))
    {
       header('location:Chat/login1.php');
    }
?>

<?php include 'Chat/nav.php'; ?>

    <!-- Header sections -->
    <header>
        <div class="container header-section flex">
            <div class="header-left">
                <h1>What and Why this Website?</h1>
                <p>This platform connects students across universities, fostering collaboration on projects and facilitating knowledge sharing. With features like project showcases, collaborative workspaces, and a job board, it empowers students for academic and professional growth. By redefining traditional education through exposure and collective knowledge, it enriches students' academic and career journeys.</p>
            </div>
            <div class="header-right">
                <img src="Chat/img/web-overview.jpg" alt="websiteInfo">
            </div>
        </div>
    </header>

    <!-- Other sections -->
    <section class="feature-section">
        <div class="container flex feature-container">
            <div class="feature-img">
                <img src="Chat/img/project-showcase.jpg" alt="projectShowcase">
            </div>
            <div class="feature-desc flex">
                <h1>Project Showcase</h1>
                <p>The Project Showcase feature enables students to exhibit their academic and collaborative endeavors. It provides a dedicated space for sharing project details, methodologies, and outcomes, fostering a dynamic platform for knowledge exchange. By offering visibility to projects through multimedia and documentation, the Showcase becomes a key component in promoting individual and collaborative achievements among students from diverse universities.</p>
            </div>
        </div>
    </section>
    <section class="feature-section">
        <div class="container flex feature-container">
            <div class="feature-desc flex">
                <h1>Collaboration Tools</h1>
                <p>Collaboration Tools within this platform serve as essential instruments for students across universities to work seamlessly on joint projects. These tools include forums, discussion boards, and messaging systems, fostering effective communication and teamwork. The platform's collaborative features aim to break down geographical barriers, creating an interactive space that encourages real-time engagement and the exchange of ideas among students pursuing shared academic interests.</p>
            </div>
            <div class="feature-img">
                <img src="Chat/img/collaboration_-tools-removebg.png" alt="collabtools">
            </div>
        </div>
    </section>
    <section class="feature-section">
        <div class="container flex feature-container">
            <div class="feature-img">
                <img src="Chat/img/upload-project.jpg" alt="uploadproject">
            </div>
            <div class="feature-desc flex">
                <h1>Upload Projects</h1>
                <p>The "Upload Projects" feature allows students to share their academic endeavors by submitting project details, including names, technologies used, and file links. This functionality provides a streamlined process for students to showcase their work, contributing to a dynamic online repository of diverse projects. By offering an easy-to-use interface for uploading project information, this feature enhances visibility, promotes collaboration, and enriches the collective knowledge pool within the platform.</p>
            </div>
        </div>
    </section>
    <section class="feature-section">
        <div class="container flex feature-container">
            <div class="feature-desc flex">
                <h1>Download Projects</h1>
                <p>The "Download Projects" feature offers users the ability to access and download a diverse array of projects uploaded by fellow students. Providing a valuable resource for learning and inspiration, this feature contributes to the platform's goal of fostering collaboration and knowledge exchange. Users can explore and download projects, gaining insights into different methodologies and approaches, thereby enriching their own academic experiences.</p>
            </div>
            <div class="feature-img">
                <img src="Chat/img/download-project.png" alt="downloadprojects">
            </div>
        </div>
    </section>

    <!-- Footer -->
    <div class="footer">
        <div class="container flex footer-container">
            <a href="#" class="hover-link">Privacy Policy</a>
            <a href="#" class="hover-link">Terms & Conditions</a>
            <a href="#" class="hover-link">Security Information</a>
        </div>

    </div>
</body>
</html>