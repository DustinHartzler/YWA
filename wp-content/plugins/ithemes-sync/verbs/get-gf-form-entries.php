<?php

/**
 * Implementation of the get-gf-form-entries verb.
 *
 * @author Aaron D. Campbell <aaron@ithemes.com>
 * @version 1.0.0
 *
 * Version History
 *   1.0.0 - 2014-07-07 - Aaron D. Campbell
 *       Initial version
 */


class Ithemes_Sync_Verb_Get_GF_Form_Entries extends Ithemes_Sync_Verb {
	public static $name = 'get-gf-form-entries';
	public static $description = 'Retrieve Gravity Forms form entries.';

	public function run( $arguments ) {
		if ( class_exists( 'RGFormsModel' ) && is_callable( array( 'RGFormsModel', 'get_form_meta' ) )
			&& class_exists( 'GFAPI' ) && is_callable( array( 'GFAPI', 'get_entries' ) ) ) {

			if ( empty( $arguments['id'] ) ) {
				return array( 'error' => 'Form ID Required' );
			}
			$return = array();
			$form_meta = GFFormsModel::get_form_meta( absint( $arguments['id'] ) );
			$return['field_labels'] = array();
			foreach ( $form_meta['fields'] as $field ) {
				if ( $field['inputs'] ) {
					foreach ( $field['inputs'] as $input ) {
						$return['field_labels'][ "{$input['id']}" ] = $input['label'];
					}
				} else {
					$return['field_labels'][ "{$field['id']}" ] = $field['label'];
				}
			}
			$return['entries'] = GFAPI::get_entries( absint( $arguments['id'] ) );
			return $return;
		}
		return false;
	}
}
