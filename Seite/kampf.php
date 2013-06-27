<!doctype html>
<html>
<?php include 'head.php'; ?>
<body>
<div id="kampf">
		<table>
				<tr>
					<td><?php include 'kampf/statusFeind.php'; ?></td>
					<td><?php include 'kampf/fillerVertikal.php'; ?></td>	
					<td><?php include 'kampf/monsterFeind.php'; ?></td>
				</tr>
				<tr>
					<td><?php include 'kampf/fillerHorizontal.php'; ?></td>
					<td><?php include 'kampf/attacke.php'; ?></td>
					<td><?php include 'kampf/fillerHorizontal.php'; ?></td>
				</tr>
				<tr>
					<td><?php include 'kampf/monster.php'; ?></td>
					<td><?php include 'kampf/fillerVertikal.php'; ?></td>
					<td><?php include 'kampf/status.php'; ?></td>
				</tr>
			</table>	
		</div>