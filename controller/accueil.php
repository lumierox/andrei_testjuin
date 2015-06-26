<?php
    $images_affiche= select("photo as p",
                                    "p.id, p.name, p.title, p.text, p.extention, p.user_id, u.login, GROUP_CONCAT(r.id) AS rubid, GROUP_CONCAT(r.title) AS rubric_title",
                                    "INNER JOIN user as u ON p.user_id = u.id
                                    LEFT JOIN rubric_has_photo AS rp ON rp.photo_id=p.id
                                    LEFT JOIN rubric AS r ON r.id = rp.rubric_id
                                    GROUP BY p.id
                                    ORDER BY p.id DESC
                                    LIMIT 20
                                    ");   
    include_once 'view/accueil.php';

