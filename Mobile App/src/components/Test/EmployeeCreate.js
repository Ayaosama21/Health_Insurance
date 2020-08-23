import React, { Component } from 'React';
import {Card, CardSection, Input, Button} from '../common';

class EmployeeCreate extends Component {
    render() {
        return (
            <Card>
                <CardSection>
                    <Input
                        label="Name"
                        placeholder="Jane"
                    />
                </CardSection>

                <CardSection>
                    <Input
                        lapel="Phone"
                        placeholder="555-555-555"
                    />
                </CardSection>

                <CardSection>

                </CardSection>
                
                <CardSection>
                    <Button>
                        Create
                    </Button>
                </CardSection>
            </Card>
        );
    }
}

export default EmployeeCreate;