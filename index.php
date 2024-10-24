<meta http-equiv="refresh" content="60" />
<style>
    <?php include 'style.css'; ?>
</style>

<?php
// Retrieve api endpoint datas
// $url = "https://paceman.gg/api/get-event-completions?eventId=6713bb5daaa1ede5c2d980d3&usePoints=false"; // Msf Id
$url = "https://paceman.gg/api/get-event-completions?eventId=66d9e28f3aa05cdeb5c8bbec&usePoints=false"; // Exemple Id

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_VERBOSE, true);

$raw = curl_exec($ch);
$jsonLeaderboard = json_decode($raw, true);
curl_close($ch);

// Trim json to keep only usefull data
$leaderboard = [];
foreach ($jsonLeaderboard as $playerData) {
    $pb = $playerData['time'];
    $pb_minutes = floor($pb / (60 * 1000));
    $pb_seconds = floor(($pb % (60 * 1000)) / 1000);

    array_push($leaderboard, [$playerData["nickname"], $pb_minutes, $pb_seconds]);
}
?>

<!-- Main content -->
<body>
    <div class="content-main">
        <!-- Podium display -->
        <div class="podium">
            <?php
            for ($i = 0; $i < 3; $i++) {
            ?>
                <div class="box">
                    <div class="skull">
                        <?php
                        if ($i == 0) {
                            echo isset($leaderboard[$i]) ? '<img id="skull-first" src="https://mc-heads.net/avatar/' . $leaderboard[$i][0] . '">' : '<img id="skull-first" src="https://mc-heads.net/avatar/MHF_Question">';
                        } else if ($i == 1) {
                            echo isset($leaderboard[$i]) ? '<img id="skull-second" src="https://mc-heads.net/avatar/' . $leaderboard[$i][0] . '">' : '<img id="skull-second" src="https://mc-heads.net/avatar/MHF_Question">';
                        } else {
                            echo isset($leaderboard[$i]) ? '<img id="skull-third" src="https://mc-heads.net/avatar/' . $leaderboard[$i][0] . '">' : '<img id="skull-third" src="https://mc-heads.net/avatar/MHF_Question">';
                        }
                        ?>
                    </div>
                    <div class="player-data">
                        <div>
                            <?php echo isset($leaderboard[$i]) ? $leaderboard[$i][0] : "xxxx" ?>
                        </div>
                        <div>
                            <?php echo isset($leaderboard[$i]) ? $leaderboard[$i][1] . ":" . $leaderboard[$i][2] : "xx:xx" ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

        <!-- Array Display -->
        <div class="container">
            <?php
            // First Array
            if (isset($leaderboard[$i])) {
                echo '<div id="tab-1" class="content valid active tab">';
            } else {
                echo '<div id="tab-1" class="content active tab">';
            };
            for ($i = 4; $i < 9; $i++) {
                if (isset($leaderboard[$i-1])) {
                    echo '<span id="lb-' . $i . '">' . $i . '. ' . $leaderboard[$i - 1][0] . ' : ' . $leaderboard[$i - 1][1] . ":" . $leaderboard[$i - 1][2] . '</span>';
                } else {
                    echo '<span id="lb-' . $i . '"></span>';
                }
            }
            echo '</div>';

            // Second Array
            if (isset($leaderboard[$i-1])) {
                echo '<div id="tab-2" class="content valid tab">';
            } else {
                echo '<div id="tab-2" class="content tab">';
            };
            for ($i = 9; $i < 14; $i++) {
                if (isset($leaderboard[$i-1])) {
                    echo '<span id="lb-' . $i . '">' . $i . '. ' . $leaderboard[$i - 1][0] . ' : ' . $leaderboard[$i - 1][1] . ":" . $leaderboard[$i - 1][2] . '</span>';
                } else {
                    echo '<span id="lb-' . $i . '"></span>';
                }
            }
            echo '</div>';

            // Third Array
            if (isset($leaderboard[$i-1])) {
                echo '<div id="tab-3" class="content valid tab">';
            } else {
                echo '<div id="tab-3" class="content tab">';
            };
            for ($i = 14; $i < 19; $i++) {
                if (isset($leaderboard[$i-1])) {
                    echo '<span id="lb-' . $i . '">' . $i . '. ' . $leaderboard[$i - 1][0] . ' : ' . $leaderboard[$i - 1][1] . ":" . $leaderboard[$i - 1][2] . '</span>';
                } else {
                    echo '<span id="lb-' . $i . '"></span>';
                }
            }
            echo '</div>';
            ?>
        </div>

        <script>
            let currentIndex = 0;
            const divs = document.querySelectorAll('.valid');

            function showNextDiv() {
                divs[currentIndex].classList.remove('active');
                currentIndex = (currentIndex + 1) % divs.length;
                divs[currentIndex].classList.add('active');
            }
            setInterval(showNextDiv, 2000);
        </script>
    </div>
</body>