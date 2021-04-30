import React from 'react';
import { NavLink } from 'react-router-dom';

export default function Header({ onChangeRoute }) {

	return (

		<>

		<div className="container">
			<div className="row">
				<div className="col-12">						

						<ul className="nav nav-pills">
							<li>
								<h2 className="mr-5">Posts</h2>
							</li>
							<li className="nav-item">
								<NavLink
									activeClassName="active"
									className="nav-link"
									to="/posts/base"
									onClick={() => onChangeRoute()}
								>Ricerca base</NavLink>
							</li>
							<li className="nav-item">
								<NavLink
									activeClassName="active"
									className="nav-link"
									to="/posts/advanced"
									onClick={() => onChangeRoute()}
								>Ricerca avanzata</NavLink>
							</li>
						</ul>

				</div>
			</div>
		</div>

		</>

	);

}