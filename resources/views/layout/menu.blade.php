<nav class="navbar navbar-default">
	<ul class="nav navbar-nav">
		<li><a href="."><img src="images/logbook.png" class="menu-logo" />ogbook</a></li>
        <li role="presentation" class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-plus"></span> {{translate('Add')}} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="add.php?type=future">{{translate('Add Future Event')}}</a></li>
		        <li><a href="add.php?type=past">{{translate('Add Past Event')}}</a></li>
            </ul>
        </li>
		<li role="presentation" class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			{{translate('View')}} <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href=".">{{translate('Today')}}</a></li>
				<li><a href="year.php?year={{today()->year}}">{{translate('Year')}}</a></li>
				<li><a href="month.php?year={{today()->year}}&month={{today()->month}}">{{translate('Month')}}</a>
			</ul>
		</li>
	</ul>
</nav>
