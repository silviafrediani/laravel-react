import React from 'react';

export default function BaseSearch({ searchTerm, setSearchTerm, handleSearch, resetSearch }) {

	return (

		<>
			<small>(Search in post author and post title)</small>
			<input type="text"
				className="form-control"
				name="testo_ricerca"
				value={searchTerm ? searchTerm : ''}
				onChange={(e) => setSearchTerm(e.target.value)}
				onKeyUp={(e) => {
					if (e.key === 'Enter') {
						handleSearch();
					}
				}}
			/>
			<div className="mt-2">
				<button className="btn btn-primary mr-2" onClick={() => handleSearch()}>CERCA</button>
				<button className="btn btn-primary" onClick={() => resetSearch()}>AZZERA</button>
			</div>
		</>

	);

}
