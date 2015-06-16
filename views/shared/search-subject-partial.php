        <div class="field">
            <div class="two columns alpha">
            <?php echo $this->formLabel('item-subject-search', __('Search By Subject')); ?>
            </div>
            <div class="five columns omega inputs">
            <?php
                echo $this->formHidden('advanced[999][element_id]', $this->subject_element_id);
                echo $this->formHidden('advanced[999][type]', $this->subject_match_type);
                echo $this->formSelect(
                    'advanced[999][terms]',
                    @$_REQUEST['advanced[999][terms]'],
                    array('id' => 'item-subject-search'),
                    $this->subjects
                );
            ?>
            </div>
        </div>