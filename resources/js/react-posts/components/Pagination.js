import React from 'react';
import ReactPaginate from 'react-paginate';

export default function Pagination({ pagination, handlePagination, currentPage }) {

	return (
		<ReactPaginate
			previousLabel={'PREV'}
			nextLabel={'NEXT'}
			breakLabel={'...'}
			breakClassName={'page-link'}
			pageCount={pagination.length}
			marginPagesDisplayed={2}
			pageRangeDisplayed={5}
			onPageChange={handlePagination}
			containerClassName={'pagination'}
			activeClassName={'active'}
			pageClassName={'page-item'}
			pageLinkClassName={'page-link'}
			previousLinkClassName={'page-link'}
			nextLinkClassName={'page-link'}
			disabledClassName={'disabled'}
			forcePage={Number(currentPage) - 1}
		/>
	);

}
