<?php
session_start(); // Start or resume a session at the very beginning
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Guest View</title>
    <link rel="stylesheet" href="css files/style.css">
    <style>
        .header-logo {
            max-height: 50px;
            width: auto;
        }
       
        h1,h3 {
            margin: 0;
            text-align: center;
        }
        footer .row {
            text-align: center;
        }
        footer .col-12 {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        footer a {
            margin: 0 10px;
        }
        footer .row.justify-content-center {
            flex-wrap: wrap;
        }
    </style>
</head>
<body>
    <header class="container">
        <div class="row align-items-center">
            <div class="col-auto">
                <img src="images/logo.jpg" alt="Logo" class="header-logo">
            </div>
            <div class="col">
                <h1>Explore our Tech News access, as a Guest</h1>
            </div>
        </div>
    </header>
    <main>
        <div style="text-align: center;">
            <a href="index.php">Let's go back to sign up for more content</a>
        </div>
    </main>
    <!-- News articles, descriptions  -->
    <section class="news-section">
        <h1>Latest News</h1>
        <article>
            <h2>How to protect yourself from iPhone thieves?</h2>
            <h3>The Rising Threat of iPhone Theft</h3>
            <p>A concerning evolution in iPhone theft has emerged, with criminals exploiting the device's recovery key feature, leaving owners unable to access their own devices. This sophisticated method involves thieves either observing the user entering their passcode or tricking them into revealing it, followed by physically stealing the phone. Once in possession, the thief can alter the Apple ID, disable "Find My iPhone", and reset the recovery key, a critical security feature designed to protect against online hackers.</p>
                
            <h3>Apple's Response and User Responsibility</h3>
            <p>Apple has acknowledged these security breaches, emphasizing its commitment to enhancing user account and data protection. The company highlights the critical nature of maintaining access to trusted devices and the recovery key, warning users that loss of both could lead to permanent account lockout. To combat this, Apple and security experts recommend several preventive measures including the use of Face ID or Touch ID to conceal passcodes, the creation of complex alphanumeric passcodes, and immediate passcode changes if compromise is suspected.</p>
                
            <h3>Preventative Measures and Data Protection</h3>
            <p>For additional security, users can employ the Screen Time settings to set up a secondary password for Apple ID changes, an unofficial but popular hack. Regular backups to iCloud or iTunes, alongside using alternative cloud services for storing sensitive data, can also mitigate the impact of theft. These strategies provide a robust defense against the increasing sophistication of digital thieves, ensuring user data and financial assets remain secure.</p>
        </article>
        <article>
            <h2>Loyal Apple customers vs Biden administation</h2>
            <h3>The Antitrust Case Against Apple</h3>

            <p>During Vox 2022 Code Conference, Apple CEO Tim Cook suggested buying an iPhone as a solution to compatibility issues between iPhones and Android devices, a comment that U.S. Attorney General Merrick Garland cited while announcing a major antitrust lawsuit against Apple. The lawsuit, joined by the Biden administration and 16 states, accuses Apple of abusing its monopoly power in the smartphone market by curating its App Store and customer experience to lock customers into its ecosystem, thereby excluding competitors. Apple, defending its position, argued that the lawsuit threatens its core principles and the unique experience its products offer, vowing to fight the charges vigorously.</p>
                
            <h3>The "Walled Garden" and Its Implications</h3>
                
            <p>The Justice Department's lawsuit highlights several practices by Apple that it alleges are detrimental to competition and consumer choice. Among these are the infamous "green bubbles" in iMessage, which signify messages sent to Android users and come with reduced functionality, thereby allegedly degrading the cross-platform messaging experience intentionally. Furthermore, the exclusivity of Apple Pay and the incompatibility of the Apple Watch with Android phones are practices that, according to the lawsuit, lock customers into Apples ecosystem and stifle competition.</p>
                
            <h3>Apple Restrictive Practices Under Scrutiny</h3>
                
            <p>The lawsuit also criticizes Apple for banning third-party app stores, forcing a 30% commission on developers, and restricting cloud-based gaming services from operating on iPhones in a user-friendly manner. Additionally, Apple's insistence on proprietary coding for apps prevents the creation of "super apps" that could operate across different operating systems, further entrenching its control over the app ecosystem. These practices, the Justice Department argues, stifle innovation and limit consumer choice, pressing for Apple to loosen its restrictions to allow for greater competition and innovation.</p>
        </article>
        <article>
            <h2>Does Apple really break the law?</h2>
            <h3>The Dual Nature of Apple's Empire</h3>

            <p>The Justice Department's lawsuit against Apple aims to dismantle the tight control Apple has over the iPhone ecosystem, spotlighting the company's dual image: a beloved creator of high-end tech and a dominant force accused of stifling competition. While Apple defends itself by questioning the evidence of customer harm, given its widespread consumer adoration, the case exposes a stark contrast. On one side, there's Apple's innovation and the seamless, secure user experience it promises; on the other, accusations of anti-competitive practices that limit consumer choice and innovation.</p>
                
            <h3>Consumer Loyalty vs. Developer Struggles</h3>
                
            <p>Apple's widespread consumer appeal is undeniable, with products that have transformed personal tech and cultivated a global following. From iPhones to MacBooks, Apple's devices are prized for their design, user-friendliness, and the "magical" experience they offer, as described in Apple's own statements. However, the company's dealings on the business side cast a shadow over its public persona. Apple is criticized for practices that undermine competitors and burden developers with high fees, leading to a love-hate relationship within the tech community and accusations of "Sherlocking" innovations.</p>
                
            <h3>The Antitrust Battle's Broader Implications</h3>
                
            <p>The DOJ's antitrust case against Apple doesn't just challenge the company's market practices but also questions the balance between consumer satisfaction and the potential benefits of increased competition. While Apple's loyal customer base might be content, the lawsuit suggests that this contentment comes at the cost of stifling innovation and choice in the smartphone market. The outcome of this legal battle could redefine the tech landscape, forcing Apple to open its "walled garden" and potentially offering consumers and developers alike more freedom and innovation.</p>
        </article>
    </section>   
    
    <footer class="container">
        <div class="row justify-content-center text-center">
            <div class="col-auto">
                <a href="index.php">Home</a>
            </div>
            <div class="col-auto">
                <a href="contact.php">Contact Us</a>
            </div>
        
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <p>&copy; 2024 Social Media Platform. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="src/js/main.js"></script>
    
</body>
</html>
