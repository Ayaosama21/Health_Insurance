import React, {Component} from 'react';
import { Text } from 'react-native';
import {connect} from 'react-redux';
import {emailChanged, passwordChanged, LoginUser} from '../Actions';
import { Card, CardSection, Input, Button, Spinner } from './common';

class LoginForm extends Component {
    onEmailChanged(text) {
        this.props.emailChanged(text);
    }

    onPasswordChange(text) {
        this.props.passwordChanged(text);
    }

    onButtonPress() {
        const {email, password } = this.props;

        this.props.LoginUser({ email, password});
    }

    renderButton() {
        if (this.props.loading) {
            return <Spinner size = "large" />
        }
        return(
            <Button onPress={this.onButtonPress.bind(this)}>
                        تسجيل الدخول
             </Button>
        );
        
    }

    render(){
        return(
            <Card>
                <CardSection>
                    <Input 
                        placeholder="user@gmail.com      "
                        label="اسم المستخدم"
                        onChangeText={email => this.setState({ email })}
                        value={this.props.email}

                    />
                </CardSection>

                <CardSection>
                    <Input 
                        secureTextEntry
                        placeholder="         كلمة السر"
                        label="كلمة السر"
                        onChangeText={password => this.setState({ password })}
                        value={this.props.password}
                    />
                </CardSection>

                <Text style={styles.errorTextStyle}>
                    {this.props.error}
                </Text>

                <CardSection>
                    {this.renderButton()}
                </CardSection>
            </Card>
        );
    }
}

const styles = {
    errorTextStyle: {
        fontSize: 20,
        alignSelf: 'center',
        color: 'red'
    }
}

const mapStateToProps = ({auth}) => {
    const { email, password, error, loading} = auth;
    return { email, password, error, loading };
};

export default connect(mapStateToProps, {emailChanged, passwordChanged, LoginUser} )(LoginForm);