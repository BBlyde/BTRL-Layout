<meta http-equiv="refresh" content="60" />
<style>
    <?php include 'style.css'; ?>
</style>

<?php
// Retrieve api endpoint datas
$url = "https://paceman.gg/api/get-event-completions?eventId=6713bb5daaa1ede5c2d980d3&usePoints=false"; // Msf Id
// $url = "https://paceman.gg/api/get-event-completions?eventId=66d9e28f3aa05cdeb5c8bbec&usePoints=false"; // Exemple Id

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

    array_push($leaderboard, [substr($playerData["nickname"],0 , 12), $pb_minutes, $pb_seconds, $playerData["nickname"]]);
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
                            echo isset($leaderboard[$i]) ? '<img id="skull-first" src="https://mc-heads.net/avatar/' . $leaderboard[$i][3] . '">' : '<img id="skull-first" src="https://mc-heads.net/avatar/MHF_Question">';
                        } else if ($i == 1) {
                            echo isset($leaderboard[$i]) ? '<img id="skull-second" src="https://mc-heads.net/avatar/' . $leaderboard[$i][3] . '">' : '<img id="skull-second" src="https://mc-heads.net/avatar/MHF_Question">';
                        } else {
                            echo isset($leaderboard[$i]) ? '<img id="skull-third" src="https://mc-heads.net/avatar/' . $leaderboard[$i][3] . '">' : '<img id="skull-third" src="https://mc-heads.net/avatar/MHF_Question">';
                        }
                        ?>
                    </div>
                    <div class="player-data">
                        <div>
                            <?php echo isset($leaderboard[$i]) ? $leaderboard[$i][0] : "xxxx" ?>
                        </div>
                        <div>
                            <?php echo isset($leaderboard[$i]) ? $leaderboard[$i][1] . ":" . ($leaderboard[$i][2] < 10 ? '0' : '') . $leaderboard[$i][2] : "xx:xx" ?>
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
                echo '<div class="content valid active tab">';
            } else {
                echo '<div class="content active tab">';
            };
            for ($i = 3; $i < 8; $i++) {
                if (isset($leaderboard[$i])) {
                    echo '<span id="lb-' . $i . '">' . $i+1 . '. ' . $leaderboard[$i][0] . ' : ' . $leaderboard[$i][1] . ":" . ($leaderboard[$i][2] < 10 ? '0' : '') . $leaderboard[$i][2] . '</span>';
                } else {
                    echo '<span id="lb-' . $i . '"></span>';
                }
            }
            echo '</div>';

            // Second Array
            if (isset($leaderboard[$i])) {
                echo '<div class="content valid tab">';
            } else {
                echo '<div class="content tab">';
            };
            for ($i = 8; $i < 13; $i++) {
                if (isset($leaderboard[$i])) {
                    echo '<span id="lb-' . $i . '">' . $i+1 . '. ' . $leaderboard[$i][0] . ' : ' . $leaderboard[$i][1] . ":" . ($leaderboard[$i][2] < 10 ? '0' : '') . $leaderboard[$i][2] . '</span>';
                } else {
                    echo '<span id="lb-' . $i . '"></span>';
                }
            }
            echo '</div>';

            // Third Array
            if (isset($leaderboard[$i])) {
                echo '<div class="content valid tab">';
            } else {
                echo '<div class="content tab">';
            };
            for ($i = 13; $i < 18; $i++) {
                if (isset($leaderboard[$i])) {
                    echo '<span id="lb-' . $i . '">' . $i+1 . '. ' . $leaderboard[$i][0] . ' : ' . $leaderboard[$i][1] . ":" . ($leaderboard[$i][2] < 10 ? '0' : '') . $leaderboard[$i][2] . '</span>';
                } else {
                    echo '<span id="lb-' . $i . '"></span>';
                }
            }
            echo '</div>';

            // Fourth Array
            if (isset($leaderboard[$i])) {
                echo '<div class="content valid tab">';
            } else {
                echo '<div class="content tab">';
            };
            for ($i = 18; $i < 23; $i++) {
                if (isset($leaderboard[$i])) {
                    echo '<span id="lb-' . $i . '">' . $i+1 . '. ' . $leaderboard[$i][0] . ' : ' . $leaderboard[$i][1] . ":" . ($leaderboard[$i][2] < 10 ? '0' : '') . $leaderboard[$i][2] . '</span>';
                } else {
                    echo '<span id="lb-' . $i . '"></span>';
                }
            }
            echo '</div>';

            // Fifth Array
            if (isset($leaderboard[$i])) {
                echo '<div class="content valid tab">';
            } else {
                echo '<div class="content tab">';
            };
            for ($i = 23; $i < 28; $i++) {
                if (isset($leaderboard[$i])) {
                    echo '<span id="lb-' . $i . '">' . $i+1 . '. ' . $leaderboard[$i][0] . ' : ' . $leaderboard[$i][1] . ":" . ($leaderboard[$i][2] < 10 ? '0' : '') . $leaderboard[$i][2] . '</span>';
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
	    setInterval(showNextDiv, 7500);
        </script>
    </div>
</body>
