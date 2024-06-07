 <!-- contac us page  -->
 <?php
 include('include/dbcon.php');
include('include/header.php');
?>
 <div class="contact">
     <div class="content">
         <div class="left-side">
             <div class="address details">
                 <i class="bi bi-geo-alt-fill"></i>
                 <div class="topic">Address</div>
                 <div class="text-one">Surkhet, NP12</div>
                 <div class="text-two">Birendranagar 06</div>
             </div>
             <div class="phone details">
                 <i class="bi bi-telephone-fill"></i>
                 <div class="topic">Phone</div>
                 <div class="text-one">+0098 9893 5647</div>
                 <div class="text-two">+0096 3434 5678</div>
             </div>
             <div class="email details">
                 <i class="bi bi-envelope"></i>
                 <div class="topic">Email</div>
                 <div class="text-one">mail@gmail.com</div>
                 <div class="text-two">mail@gmail.com</div>
             </div>
         </div>
         <div class="right-side">
             <div class="topic-text">Send us a message</div>
             <p>If you have any work from me or any types of quries related to my tutorial, you can send me message
                 from here. It's my pleasure to help you.</p>
             <form action="contact_db.php" method="post" id="formSave" enctype="multipart/form-data">
                 <div class="input-box">
                     <input type="text" name="name" placeholder="Enter your name">
                 </div>
                 <div class="input-box">
                     <input type="text" name="email" placeholder="Enter your email">
                 </div>
                 <div class="input-box message-box">
                     <textarea name="message" placeholder="Enter your message"></textarea>
                 </div>
                 <div class="button">
                     <input type="submit"  class="sbtn" name="contactbtn" value="Send Now">
                 </div>
             </form>
         </div>
     </div>
 </div>
 <section class="map_sec">
     <div class="container">
         <div class="row">
             <div class="col-md-10 offset-md-1">
                 <div class="map_inner">
                     <h4>Find Us on Google Map</h4>
                     <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore quo beatae quasi assumenda,
                         expedita aliquam minima tenetur maiores neque incidunt repellat aut voluptas hic dolorem
                         sequi ab porro, quia error.</p>
                     <div class="map_bind">
                         <iframe
                             src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d471220.5631094339!2d88.04952462217592!3d22.6757520733225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f882db4908f667%3A0x43e330e68f6c2cbc!2sKolkata%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1596988408134!5m2!1sen!2sin"
                             width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""
                             aria-hidden="false" tabindex="0"></iframe>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>