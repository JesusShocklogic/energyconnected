<?php

function apply_collapse_data_to($rows){

	$normal_row = function($data){
		$text = $data["text"];
		return <<<RESULT
			<div class="fs-6 text-black">
				$text
			</div>
		RESULT;
	};

	$collapse_row = function($data){
		$id = $data["id"];
		$title = $data["title"];
		$text = $data["text"];
		return <<<RESULT
			<div class="py-2">
				<div class="py-2">
					<a 
						class="collapse-toggle h4 fw-bold text-black" 
						data-bs-toggle="collapse" 
						href="#collapse-$id" 
						role="button" 
						aria-expanded="false" 
						aria-controls="collapse-$id"
					>
						$title
					</a>
				</div>
				<div class="collapse fs-6 text-black" id="collapse-$id">
					$text
				</div>
			</div>
		RESULT;
	};

	$show_row_like = array(
		"normal text" => $normal_row,
		"collapse text" => $collapse_row,
	);

	$result = <<<RESULT
		<div class="side-padding">
	RESULT;
	foreach ($rows as $key => $row):
		$row_type = $row["type"];
		$row_data = array_merge($row, array ("id" => $key));
		$show_row = $show_row_like[$row_type];
		$result .= $show_row($row_data);
	endforeach;
	$result .= <<<RESULT
		</div>
	RESULT;

	return $result;
}
