<table>
    <thead>
        <tr>
            <th>Ime</th>
            <th>Priimek</th>
            <th>E-pošta</th>
            <th>Discord</th>
            <th>Playstation ID</th>     
            <th>Datum rojstva</th>                    
            <th>Državljanstvo</th>
            <th>Poštna številka</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach(tournament::getPlayerEFootball($game['apply_end_time'], $game['apply_start_time']) as $application) { ?>
        <tr>
            <td><?= $application['player_name'] ?></td>
            <td><?= $application['player_surname'] ?></td>
            <td><?= $application['email'] ?></td>
            <td><?= $application['discord'] ?></td>
            <td><?= $application['playstation_id'] ?></td>
            <td><?= $application['date_of_birth'] ?></td>
            <td><?= $application['nationality'] ?></td>
            <td><?= $application['postal_code'] ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>