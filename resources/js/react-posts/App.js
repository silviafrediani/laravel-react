import React, { useState, useEffect }from 'react';
import { BrowserRouter, Route } from 'react-router-dom';
import Header from './components/Header';
import BaseSearch from './components/BaseSearch';
import AdvancedSearch from './components/AdvancedSearch';
import OpereList from './components/OpereList';
import Pagination from './components/Pagination';
import Loading from './components/Loading';


export default function App(props) {

	const [loading, setLoading] = useState(true);

	const [opere, setOpere] = useState([]);

	const [searchTerm, setSearchTerm] = useState('');

	const [newSearchTerm, setNewSearchTerm] = useState('');

	const [currentPage, setCurrentPage] = useState(1);

	const [pagination, setPagination] = useState([]);

	const [route, setRoute] = useState(false);


	useEffect(() => {
		//console.log(opere.length);
		fetch('http://localhost/api/posts?page=' + currentPage, {
			method: 'post',
			headers: {
				'Accept': 'application/json',
				'Content-Type': 'application/json'
			},
			body: JSON.stringify({ term: newSearchTerm ? newSearchTerm : '' })
		})
		.then(response => response.json())
		.then(results => {
			//console.log(results.data);
			//console.log(results.meta);
			//console.log(results.links);
			setOpere(results.data);
			setPagination(results.links);
			setLoading(false);
		})
		;

	}, [newSearchTerm, currentPage, route]);

	const handleSearch = () => {
		setNewSearchTerm(searchTerm);
		setCurrentPage(1);
	}

	let rotta;
	const resetSearch = (rotta) => {
		setNewSearchTerm('');
		setSearchTerm('');
		setCurrentPage(1);
		setLoading(true);
		if (rotta==true)
		{
			setRoute(!route);
		}
	}

	const handlePagination = (data) => {
		setCurrentPage(data.selected + 1);
		setLoading(true);
	}

	const withOpereLoading = (Component) => (props) =>
		loading
			? <Loading />
			: <Component {...props} />

	const withOpereEmpty = (Component) => (props) =>
		!opere.length
			? <div className="mt-5">Nessun risultato!</div>
			: <Component {...props} />

	const OpereListWithConditionalRendering = withOpereLoading(withOpereEmpty(OpereList));

	return (

		<BrowserRouter>
			<Header onChangeRoute={() => resetSearch(rotta=true)}/>
			<div className="container">
				<Route path="/posts/base">
					<BaseSearch
						searchTerm={searchTerm}
						setSearchTerm={setSearchTerm}
						handleSearch={handleSearch}
						resetSearch={resetSearch}
					/>
				</Route>
				<Route path="/posts/advanced">
					<AdvancedSearch
						searchTerm={searchTerm}
						setSearchTerm={setSearchTerm}
						handleSearch={handleSearch}
						resetSearch={resetSearch}
					/>
				</Route>
				{
					pagination.length != 0 &&
					<div className="mt-5">
						<Pagination
							pagination={pagination}
							handlePagination={handlePagination}
							currentPage={currentPage}
						/>
					</div>
				}
				<OpereListWithConditionalRendering opere={opere} />
			</div>
		</BrowserRouter>

	);

}