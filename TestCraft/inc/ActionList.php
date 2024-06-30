<div class="justify-content-center align-items-center d-flex">
    <div class="center-list w-75">
        <a class="btn btn-primary mt-5 mb-3" href="ListTests.php?do=AddTest">Добавить тест</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">№</th>
                    <th style="min-width:200px;" scope="col">Название теста</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $userId = $_SESSION['user']['id'];
                $res = $db->query("SELECT * FROM tests WHERE users_id = $userId");
                $count = 1;
                while ($row = $res->fetch()) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $count; ?></th>
                        <td><a href="ViewingTest.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></td>
                        <td>
                            <a href="ListTests.php?do=DeleteTest&id=<?php echo $row['id']; ?>" class="delete-test text-decoration-none">
                                <img style="width: 2%" src="red.png">
                            </a>

                            <a href="ListTests.php?do=DeleteTest&id=<?php echo $row['id']; ?>" class="delete-test">
                                <img style="width: 2%" src="korzina.png">
                            </a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#shareModal<?php echo $row['id']; ?>" data-test-title="<?php echo $row['title']; ?>">
                                Поделиться
                            </button>

                            <div class="modal fade" id="shareModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="shareModalLabel">Код доступа</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="input-group">
                                                <input type="text" id="accessCode<?php echo $row['id']; ?>" class="form-control" value="<?php echo $row['access_code']; ?>" readonly>
                                                <button type="button" class="btn btn-primary" onclick="copyToClipboard('accessCode<?php echo $row['id']; ?>')">
                                                    Скопировать
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#resultModal<?php echo $row['id']; ?>" data-test-title="<?php echo $row['title']; ?>">
                                Результаты
                            </button>

                            <div class="modal fade" id="resultModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="resultModalLabel">Результаты прохождения</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">                  
                                            <div class="input-group" style="text-align: center;">
                                            <?php
                                                $testId = $row['id']; 
                                                $userResults = $db->query("SELECT ur.max_score, ur.score, u.name, u.avatar
                                                                            FROM user_result ur
                                                                            JOIN users u ON ur.users_id = u.id
                                                                            WHERE ur.test_id = $testId")->fetchAll();

                                                if ($userResults) {
                                                    foreach ($userResults as $userResult) {
                                                        $max_result = $userResult['max_score'];
                                                        $score = $userResult['score'];
                                                        $name = $userResult['name'];
                                                        $avatar = $userResult['avatar'];
                                                        
                                                        echo '<div style="display: flex; align-items: center; margin-bottom: 10px;">';
                                                        echo '  <div style="margin-right: 10px;">
                                                                    <img class="avatar" src="' . $avatar . '" alt="Avatar">
                                                                </div>';
                                                        echo '  <div>';
                                                        echo "    <div>$name: $score из $max_result баллов</div>";
                                                        echo '  </div>';
                                                        echo '</div>';
                                                        echo '<br>';
                                                    }
                                                } else {
                                                    echo "Результаты отсутствуют";
                                                }
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                    $count++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function copyToClipboard(elementId) {
    var inputElement = document.getElementById(elementId);
    inputElement.select();
    inputElement.setSelectionRange(0, 99999);
    document.execCommand("copy");
    }
</script>