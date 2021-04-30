import React from 'react';

export default function OpereList({ opere }) {

	return (

		<table className="table">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Author</th>
					<th scope="col">Post Title</th>
				</tr>
			</thead>
			<tbody>
				{
					opere.length != 0 && opere.map((opera) => {
						return (
							<tr key={opera.id}>
								<th scope="row">{opera.id}</th>
								<td>{opera.post_author}</td>
								<td>{opera.post_title}</td>
							</tr>
						)
					})
				}
			</tbody>
		</table>

	);

}
