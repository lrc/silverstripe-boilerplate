<?php
/**
 * Provide an admin interface for browsing/editing form submission data. *
 */
class ExtendedModelAdmin extends ModelAdmin {
	public static $collection_controller_class = "ExtendedModelAdmin_CollectionController";
}

/**
 * Define the controller clas so we can remove the add form.
 */
class ExtendedModelAdmin_CollectionController extends ModelAdmin_CollectionController {
	/**
	 * Creates and returns the result table field for resultsForm.
	 * Uses {@link resultsTableClassName()} to initialise the formfield.
	 * Method is called from {@link ResultsForm}.
	 *
	 * @param array $searchCriteria passed through from ResultsForm
	 *
	 * @return TableListField
	 */
	function getResultsTable($searchCriteria) {
		$summaryFields = $this->getResultColumns($searchCriteria);

		$className = $this->parentController->resultsTableClassName();
		
		$tf = new $className(
			$this->modelClass,
			$this->modelClass,
			$summaryFields
		);

		$tf->setCustomQuery($this->getSearchQuery($searchCriteria));
		$tf->setPageSize($this->parentController->stat('page_length'));
		$tf->setShowPagination(true);

		// @todo Remove records that can't be viewed by the current user
		$tf->setPermissions(array_merge(array('view','export'), TableListField::permissions_for_object($this->modelClass)));

		// Get the custom static
		$csvFields = singleton($this->modelClass)->stat('csv_fields');

		if ($csvFields) {
			// if fields were passed in numeric array,
			// convert to an associative array
			if($csvFields && array_key_exists(0, $csvFields)) {
				$csvFields = array_combine(array_values($csvFields), array_values($csvFields));
			}
			$exportFields = $csvFields;
		}
		else
		{
			$exportFields = $this->getResultColumns($searchCriteria, false);
		}

		$tf->setFieldListCsv($exportFields);

		$url = '<a href=\"' . $this->Link() . '/$ID/edit\">$value</a>';
		$tf->setFieldFormatting(array_combine(array_keys($summaryFields), array_fill(0,count($summaryFields), $url)));

		return $tf;
	}
}