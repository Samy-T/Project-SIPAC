<?php
if (isset($_POST['submit'])) {
    $to = "webphptest3@gmail.com";
    $from = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $subject = "Form - Comuna Eftimie Murgu";
    $message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
    $headers = "From:" . $from;
    mail($to, $subject, $message, $headers);
}

?>
<!DOCTYPE html>
<html>
    <body>
        <!--Content-->
        <section id="main-content">
            <div id="container">
                <div class="Content0">
                    <div style="text-align: center;">
                        <b><h1>Date Contact</h1></b>
                    </div><br>

                    Adresa:<i> Eftimie Murgu, nr. 265, județul Caraș Severin, C.P. 327190 </i><br>
                    Telefon:<i> 0255.243.210 </i><br>
                    Fax:<i> 0255.243.210 </i><br>
                    Email:<i> emurguprimar@yahoo.com </i><br>
                    Web:<a href="http://www.primariaeftimiemurgu.ro/" target="_blank" style="text-decoration:none; color:orange;"><i> www.primariaeftimiemurgu.ro </i></a>
                    <br><br>

                    <fieldset class="form">
                        <legend>Trimiteți-ne un e-mail și noi vă vom răspunde</legend>
                        <div class="form1">
                            <form method="post">
                                Nume:<br>
                                    <input type="text" name="last_name" required><br>
                                Prenume:<br>
                                    <input type="text" name="first_name" required><br>
                                E-mail:<br>
                                    <input type="text" name="email" required><br><br>
                                Mesaj:<br>
                                    <textarea rows="10" name="message" cols="50" required></textarea><br>

                                <input type="submit" value="Trimite" name="submit">
                                <input type="reset" value="Șterge">
                            </form>
                        </div>
                        <div class="form2">
                            <iframe style="border: 0;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5654.533278842437!2d22.09232262517218!3d44.877222441356174!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4751be08f94c6229%3A0x5be9b7db3d573799!2sPRIM%C4%82RIA+EFTIMIE+MURGU!5e0!3m2!1sro!2sro!4v1484652973602" width="500" height="400" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
                        </div>
                    </fieldset>
                </div>
            </div>
        </section>
    </body>
</html>