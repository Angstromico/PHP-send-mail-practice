<?php require_once 'components/input.php'; ?>

<!doctype html>
<html lang="en">
 <head>
  <title>Form Mails</title>
  <meta charset="utf-8" />
  <meta
   name="viewport"
   content="width=device-width, initial-scale=1, shrink-to-fit=no"
  />

  <link
   href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
   rel="stylesheet"
   integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
   crossorigin="anonymous"
  />
 </head>

 <body data-bs-theme="dark">
  <main>
   <div class="row justify-content-center mt-4">
    <div class="col-4">
     <div class="card shadow">
      <div class="card-body">
       <h3 class="card-title">Contact Form</h3>
       <form action="send.php" method="post">
        <?php 
          renderInput([
              'label' => 'Subject',
              'name'  => 'subject',
              'placeholder' => 'How can we help?'
          ]);

          renderInput([
              'label' => 'Description',
              'name'  => 'description',
              'placeholder' => 'Give us more details...',
              'isTextArea' => true
          ]);
        ?>

        <button type="submit" class="btn btn-primary">Send Email</button>
       </form>
       </div>
      </div>
     </div>
    </div>
  </main>
  <script
   src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
   integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
   crossorigin="anonymous"
  ></script>

  <script
   src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
   integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
   crossorigin="anonymous"
  ></script>
 </body>
</html>

<!--  -->
