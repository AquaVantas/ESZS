<table>
    <thead>
        <tr>
            <th>Ime</th>
            <th>Priimek</th>
            <th>E-pošta</th>
            <th>Discord</th>
            <th>Nickname</th>                                     
            <th>Ekipa</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach(tournament::getPlayerCSGO($game['apply_end_time'], $game['apply_start_time']) as $application) { ?>
        <tr>
            <td><?= $application['player_name'] ?></td>
            <td><?= $application['player_surname'] ?></td>
            <td><?= $application['email'] ?></td>
            <td><?= $application['discord'] ?></td>
            <td><?= $application['nickname'] ?></td>
            <td><?= $application['team'] ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>