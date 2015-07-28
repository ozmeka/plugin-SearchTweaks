        <div class="field">
            <div class="two columns alpha">
            <?php echo $this->formLabel('item-subject-search', __('Search By Subject')); ?>
            </div>
            <div class="five columns omega inputs">
            <?php
                echo $this->formHidden('advanced[999][element_id]', null);
                echo $this->formHidden('advanced[999][type]', $this->subject_match_type);
                echo $this->formSelect(
                    'advanced[999][terms]',
                    @$_REQUEST['advanced[999][terms]'],
                    array('id' => 'item-subject-search'),
                    $this->subjects
                );
                
                //  javascript to prevent advanced search allowing an empty terms string 
                //  through which it does when element_id has a value...
            ?>
                <script language="javascript" type="text/javascript">
                    jQuery('#item-subject-search').change(function () {
                        if (jQuery('#item-subject-search').val().trim()) {
                            jQuery('#advanced-999-element_id').val(<?php echo $this->subject_element_id; ?>);
                        }
                        else
                        {
                            jQuery('#advanced-999-element_id').val(null);
                        }
                    });
                </script>
            </div>
        </div>