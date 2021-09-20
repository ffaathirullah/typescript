import React from "react";
import { View, StyleSheet, Text, ScrollView, Image } from "react-native";

import Input from "../../components/auth/Inputs";
import Submit from "../../components/auth/Submit";

const SignUp = (props) => {
  return (
    <ScrollView style={{ backgroundColor: "#0F0E0E" }}>
      <View style={styles.container}>
        <Text style={styles.textTitle}>Let's Get Started</Text>
        <Text style={styles.textBody}>
          Create an account to get all features
        </Text>
        <Input name="Full Name" icon="user" />
        <Input name="Email" icon="envelope" />
        <Input name="Phone" icon="phone" />
        <Input name="Password" icon="lock" pass={true} />
        <Input name="Confirm Password" icon="lock" pass={true} />
        <Submit color="#0251ce" title="CREATE" />
        <View style={{ flexDirection: "row" }}>
          <Text style={styles.textBody}>Aiready have an account </Text>
          <Text
            style={[styles.textBody, { color: "#4096FE" }]}
            onPress={() => props.navigation.navigate("Login")}
          >
            Login here
          </Text>
        </View>
      </View>
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    alignItems: "center",
    justifyContent: "center",
    color: "#fff",
    marginTop: 40,
  },
  image: {
    width: 400,
    height: 250,
    marginVertical: 10,
  },
  textTitle: {
    fontFamily: "Foundation",
    fontSize: 40,
    marginVertical: 10,
    color: "#fff",
  },
  textBody: {
    fontFamily: "Foundation",
    fontSize: 16,
    color: "#fff",
  },
});

export default SignUp;
