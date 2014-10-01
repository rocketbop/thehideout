<?php

function printOptionsPageHeader( $insSection = '' ) {
	$sLinkedIcwp = '<a href="http://icwp.io/3a" target="_blank">iControlWP</a>';
	echo '<div class="page-header">';
	echo '<h2><a id="pluginlogo_32" class="header-icon32" href="http://icwp.io/2k" target="_blank"></a>';
	$sBaseTitle = sprintf( _wptb__( 'WordPress Twitter Bootstrap (from %s)' ), $sLinkedIcwp );
	if ( !empty($insSection) ) {
		echo sprintf( '%s :: %s', $insSection, $sBaseTitle );
	}
	else {
		echo $sBaseTitle;
	}
	echo '</h2></div>';
}

function getIsHexColour($insColour) {
	return preg_match( '/^#[a-fA-F0-9]{3,6}$/', $insColour );
}

function printAllPluginOptionsForm( $inaAllPluginOptions, $insVarPrefix = '', $nOptionsPerRow = 1 ) {
	
	if ( empty($inaAllPluginOptions) ) {
		return;
	}

	$nRowWidth = 8; //8 spans.
	$iOptionWidth = $nRowWidth / $nOptionsPerRow;

	//Take each Options Section in turn
	foreach ( $inaAllPluginOptions as $nSection => $sOptionSection ) {
		
		$sRowId = str_replace( ' ', '', $sOptionSection['section_title'] );
		//Print the Section Title
		echo '
				<div class="row" id="'.$sRowId.'">
					<div class="span9" style="margin-left:0px">
						<fieldset>
							<legend>'.$sOptionSection['section_title'].'</legend>
		';
		
		$nRowCount = 1;
		$nOptionCount = 0;

		$iOptionWidth = ( $nSection === 0 ) ? $nRowWidth : $nRowWidth / $nOptionsPerRow;

		//Print each option in the option section
		foreach ( $sOptionSection['section_options'] as $aOption ) {

			$nOptionCount = $nOptionCount % $nOptionsPerRow;

			if ( $nOptionCount == 0 ) {
				echo '
				<div class="row row_number_'.$nRowCount.'">';
			}
			
			echo getPluginOptionSpan( $aOption, $iOptionWidth, $insVarPrefix );

			$nOptionCount++;

			if ( $nOptionCount == $nOptionsPerRow ) {
				echo '
				</div> <!-- / options row -->';
				$nRowCount++;
			}
	
		}//foreach option
	
		echo '
					</fieldset>
				</div>
			</div>
		';

	}

}

function getPluginOptionSpan( $inaOption, $iSpanSize, $insVarPrefix = '' ) {
	
	list( $sOptionKey, $sOptionSaved, $sOptionDefault, $mOptionType, $sOptionHumanName, $sOptionTitle, $sOptionHelpText, $sHelpLink ) = array_pad( $inaOption, 8, '' );
	if ( $sOptionKey == 'spacer' ) {
		$sHtml = '
			<div class="span'.$iSpanSize.'">
			</div>
		';
	} else {

		$sHelpLink = !empty($sHelpLink)? '<span>['.$sHelpLink.']</span>' : '';
		$sSpanId = 'span_'.$insVarPrefix.$sOptionKey;
		$sHtml = '
			<div class="item_group span'.$iSpanSize.' '.( ($sOptionSaved === 'Y' || $sOptionSaved != $sOptionDefault )? ' selected_item_group':'' ).'" id="'.$sSpanId.'">
				<div class="control-group">
					<label class="control-label" for="'.$insVarPrefix.$sOptionKey.'">'.$sOptionHumanName.'<br />'.$sHelpLink.'</label>
					<div class="controls">
					  <div class="option_section'.( ($sOptionSaved == 'Y')? ' selected_item':'' ).'" id="option_section_'.$insVarPrefix.$sOptionKey.'">
						<label>
		';
		$sAdditionalClass = '';
		$sHelpSection = '';
		
		if ( $mOptionType === 'checkbox' ) {
			
			$sChecked = ( $sOptionSaved == 'Y' )? 'checked="checked"' : '';
			
			$sHtml .= '
				<input '.$sChecked.'
						type="checkbox"
						name="'.$insVarPrefix.$sOptionKey.'"
						value="Y"
						class="'.$sAdditionalClass.'"
						id="'.$insVarPrefix.$sOptionKey.'" />
						'.$sOptionTitle;

		}
		else if ( $mOptionType === 'text' ) {
			$sTextInput = esc_attr( $sOptionSaved );
			$sHtml .= '
				<p>'.$sOptionTitle.'</p>
				<input type="text"
						name="'.$insVarPrefix.$sOptionKey.'"
						value="'.$sTextInput.'"
						placeholder="'.$sTextInput.'"
						id="'.$insVarPrefix.$sOptionKey.'"
						class="span5" />';
		}
		else if ( $mOptionType === 'password' ) {
			$sTextInput = esc_attr( $sOptionSaved );
			$sHtml .= '
				<p>'.$sOptionTitle.'</p>
				<input type="password"
						name="'.$insVarPrefix.$sOptionKey.'"
						value="'.$sTextInput.'"
						placeholder="'.$sTextInput.'"
						id="'.$insVarPrefix.$sOptionKey.'"
						class="span5" />';
		}
		else if ( $mOptionType === 'email' ) {
			$sTextInput = esc_attr( $sOptionSaved );
			$sHtml .= '
				<p>'.$sOptionTitle.'</p>
				<input type="text"
						name="'.$insVarPrefix.$sOptionKey.'"
						value="'.$sTextInput.'"
						placeholder="'.$sTextInput.'"
						id="'.$insVarPrefix.$sOptionKey.'"
						class="span5" />';

		}
		else if ( is_array($mOptionType) ) { //it's a select, or radio

			if ( isset( $mOptionType['type'] ) ) {
				$sInputType = $mOptionType['type'];
				unset( $mOptionType['type'] );
			}
			else {
				$sInputType =  array_shift($mOptionType);
			}

			if ( $sInputType == 'select' ) {

				$sFragment = '<p>'.$sOptionTitle.'</p>
				<select
				id="'.$insVarPrefix.$sOptionKey.'"
				name="'.$insVarPrefix.$sOptionKey.'">';

				foreach( $mOptionType as $aInput ) {

					list( $mOptionValue, $sOptionName ) = $aInput;
					$fSelected = $sOptionSaved == $mOptionValue;

					$sFragment .= '
					<option
					value="'.$mOptionValue.'"
					id="'.$insVarPrefix.$sOptionKey.'_'.$mOptionValue.'"'
						.( $fSelected? ' selected="selected"' : '') .'>'. $sOptionName.'</option>';
				}
				$sFragment .= '</select>';

			}
			if ( $sInputType == 'multiple_select' ) {

				$sFragment = '<p>'.$sOptionTitle.'</p>
				<select
				id="'.$insVarPrefix.$sOptionKey.'"
				name="'.$insVarPrefix.$sOptionKey.'[]" multiple multiple="multiple" size="'.count($mOptionType).'">';

				foreach( $mOptionType as $mOptionValue => $sOptionName ) {

					$fSelected = in_array( $mOptionValue, $sOptionSaved );

					$sFragment .= '
					<option
					value="'.$mOptionValue.'"
					id="'.$insVarPrefix.$sOptionKey.'_'.$mOptionValue.'"'
						.( $fSelected? ' selected="selected"' : '') .'>'. $sOptionName.'</option>';
				}
				$sFragment .= '</select>';
			}

			$sHtml .= $sFragment;
		}
		else if ( $mOptionType === 'ip_addresses' ) {
			$sTextInput = esc_attr( $sOptionSaved );
			$nRows = substr_count( $sTextInput, "\n" ) + 1;
			$sHtml .= '
				<p>'.$sOptionTitle.'</p>
				<textarea type="text"
						name="'.$insVarPrefix.$sOptionKey.'"
						placeholder="'.$sTextInput.'"
						id="'.$insVarPrefix.$sOptionKey.'"
						rows="'.$nRows.'"
						class="span5">'.$sTextInput.'</textarea>';

			$sOptionHelpText = '<p class="help-block">'.$sOptionHelpText.'</p>';

		}
		else if ( $mOptionType === 'yubikey_unique_keys' ) {
			$sTextInput = esc_attr( $sOptionSaved );
			$nRows = substr_count( $sTextInput, "\n" ) + 1;
			$sHtml .= '
				<p>'.$sOptionTitle.'</p>
				<textarea type="text"
						name="'.$insVarPrefix.$sOptionKey.'"
						placeholder="'.$sTextInput.'"
						id="'.$insVarPrefix.$sOptionKey.'"
						rows="'.$nRows.'"
						class="span5">'.$sTextInput.'</textarea>';

			$sOptionHelpText = '<p class="help-block">'.$sOptionHelpText.'</p>';

		}
		else if ( $mOptionType === 'comma_separated_lists' ) {
			$sTextInput = esc_attr( $sOptionSaved );
			$nRows = substr_count( $sTextInput, "\n" ) + 1;
			$sHtml .= '
				<p>'.$sOptionTitle.'</p>
				<textarea type="text"
						name="'.$insVarPrefix.$sOptionKey.'"
						placeholder="'.$sTextInput.'"
						id="'.$insVarPrefix.$sOptionKey.'"
						rows="'.$nRows.'"
						class="span5">'.$sTextInput.'</textarea>';
		}
		else if ( $mOptionType === 'integer' ) {
			$sTextInput = esc_attr( $sOptionSaved );
			$sHtml .= '
				<p>'.$sOptionTitle.'</p>
				<input type="text"
						name="'.$insVarPrefix.$sOptionKey.'"
						value="'.$sTextInput.'"
						placeholder="'.$sTextInput.'"
						id="'.$insVarPrefix.$sOptionKey.'"
						class="span5" />';

		}
		else if ( strpos( $mOptionType, 'less_' ) === 0 ) {	//dealing with the LESS compiler options

			if ( empty($sOptionSaved) ) {
				$sOptionSaved = $sOptionDefault;
			}

			$sHtml .= '<input class="span2'.$sAdditionalClass.'"
						type="text"
						placeholder="'.esc_attr( $sOptionSaved ).'"
						name="'.$insVarPrefix.$sOptionKey.'"
						value="'.esc_attr( $sOptionSaved ).'"
						id="'.$insVarPrefix.$sOptionKey.'" />';

			$sToggleTextInput = '';

			$sHelpSection = '
					<div class="help_section">
						<span class="label label-less-name">@'.str_replace( 'less_', '', $sOptionKey ).'</span>
						'.$sToggleTextInput.'
						<span class="label label-less-name">'.$sOptionDefault.'</span>
					</div>';

		} else {
			$sHtml .= 'we should never reach this point';
		}

//		$sOptionHelpText = '<p class="help-block">'
//			.$sOptionHelpText
//			.( isset($sHelpLink)? '<br /><span class="help-link">['.$sHelpLink.']</span>':'' )
//			.'</p>';
		
		$sOptionHelpText = '<p class="help-block">'.$sOptionHelpText.'</p>';

		$sHtml .= '
						</label>
						'.$sOptionHelpText.'
						<div style="clear:both"></div>
					  </div>
					</div><!-- controls -->'
					.$sHelpSection.'
				</div><!-- control-group -->
			</div>
		';
	}
	
	return $sHtml;
}
