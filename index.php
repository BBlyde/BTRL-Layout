<style>
    <?php include 'style.css'; ?>
</style>

<?php
// MSF
// $url = "https://paceman.gg/api/get-event-completions?eventId=6713bb5daaa1ede5c2d980d3&usePoints=false";
// TEST
$url = "https://paceman.gg/api/get-event-completions?eventId=66d9e28f3aa05cdeb5c8bbec&usePoints=false";
$raw = file_get_contents($url);
$jsonLeaderbaord = json_decode($raw, true);

$leaderboard = [];
foreach ($jsonLeaderbaord as $playerData) {
    // var_dump($playerData);
    $pb = $playerData['time'];
    $pb_minutes = floor($pb / (60 * 1000));
    $pb_seconds = floor(($pb % (60 * 1000)) / 1000);

    array_push($leaderboard, [$playerData["nickname"], $pb_minutes, $pb_seconds]);
}

usort($leaderboard, function ($a, $b) {
    if ($a[1] > $b[1]) {
        return 1;
    } elseif ($a[1] < $b[1]) {
        return -1;
    } else {
        if ($a[2] > $b[2]) {
            return 1;
        } elseif ($a[2] < $b[2]) {
            return -1;
        } else {
            return 0;
        }
    }
});
?>

<body>
    <div class="content-main">
        <div class="podium">
            <?php
            for ($i = 0; $i < 3; $i++) {
            ?>
                <div class="box">
                    <div class="skull">
                        <?php
                        if ($i == 0) {
                            echo isset($leaderboard[$i]) ? '<img id="skull-first" src="https://mc-heads.net/avatar/' . $leaderboard[$i][0] . '">' : '<img id="skull-first" src="https://mc-heads.net/avatar/MHF_Question"';
                        } else if ($i == 1) {
                            echo isset($leaderboard[$i]) ? '<img id="skull-second" src="https://mc-heads.net/avatar/' . $leaderboard[$i][0] . '">' : '<img id="skull-first" src="https://mc-heads.net/avatar/MHF_Question"';
                        } else {
                            echo isset($leaderboard[$i]) ? '<img id="skull-third" src="https://mc-heads.net/avatar/' . $leaderboard[$i][0] . '">' : '<img id="skull-first" src="https://mc-heads.net/avatar/MHF_Question"';
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

        <div class="container">
            <div id="tab-1" class="content active tab">
                <?php
                for ($i = 4; $i < 9; $i++) {
                    if (isset($leaderboard[$i])) {
                        echo '<span id="lb-' . $i . '">' . $leaderboard[$i - 1][0] . ' : ' . $leaderboard[$i - 1][1] . ":" . $leaderboard[$i - 1][2] . '</span>';
                    } else {
                        echo '<span id="lb-' . $i . '"></span>';
                    }
                }
                ?>
            </div>

            <div id="tab-2" class="content tab">
                <?php
                for ($i = 9; $i < 14; $i++) {
                    if (isset($leaderboard[$i])) {
                        echo '<span id="lb-' . $i . '">' . $leaderboard[$i - 1][0] . ' : ' . $leaderboard[$i - 1][1] . ":" . $leaderboard[$i - 1][2] . '</span>';
                    } else {
                        echo '<span id="lb-' . $i . '"></span>';
                    }
                }
                ?>
            </div>

            <div id="tab-3" class="content tab">
                <?php
                for ($i = 14; $i < 19; $i++) {
                    if (isset($leaderboard[$i])) {
                        echo '<span id="lb-' . $i . '">' . $leaderboard[$i - 1][0] . ' : ' . $leaderboard[$i - 1][1] . ":" . $leaderboard[$i - 1][2] . '</span>';
                    } else {
                        echo '<span id="lb-' . $i . '"></span>';
                    }
                }
                ?>
            </div>
        </div>

        <script>
            let currentIndex = 0;
            const divs = document.querySelectorAll('.content');

            function showNextDiv() {
                divs[currentIndex].classList.remove('active');
                currentIndex = (currentIndex + 1) % divs.length;
                divs[currentIndex].classList.add('active');
            }
            setInterval(showNextDiv, 2000);
        </script>
    </div>
</body>