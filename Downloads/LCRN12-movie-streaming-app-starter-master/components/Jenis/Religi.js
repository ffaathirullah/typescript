import React from "react";
import {
  View,
  Text,
  TouchableOpacity,
  Image,
  FlatList,
  TouchableWithoutFeedback,
  ScrollView,
  StyleSheet,
} from "react-native";
import {
  dummyData,
  COLORS,
  SIZES,
  FONTS,
  icons,
  images,
} from "../../constants";
import { Profiles, ProgressBar } from "../../components";
import BottomIcon from "./../BottomIcon";
import RenderHead from "./../RenderHead";
const Religi = ({ navigation }) => {
  return (
    <ScrollView style={styles.container}>
      <RenderHead />
      <View style={styles.iconLayanan}>
        <BottomIcon title="Pijar TV" type="layanan" />
        <BottomIcon title="Pijar TV" type="layanan" />
        <BottomIcon title="Pijar TV" type="layanan" />
        <BottomIcon title="Pijar TV" type="layanan" />
        <BottomIcon title="Pijar TV" type="layanan" />
        <BottomIcon title="Pijar TV" type="layanan" />
        <BottomIcon title="Pijar TV" type="layanan" />
        <BottomIcon title="Pijar TV" type="layanan" />
        <BottomIcon title="Pijar TV" type="layanan" />
        <BottomIcon title="Pijar TV" type="layanan" />
        <BottomIcon title="Pijar TV" type="layanan" />
        <BottomIcon title="Pijar TV" type="layanan" />
      </View>
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  container: {
    backgroundColor: "#000",
    flex: 1,
  },
  iconLayanan: {
    flexDirection: "row",
    justifyContent: "flex-start",
    alignContent: "space-between",
    marginVertical: 10,
    marginHorizontal: 10,
    flexWrap: "wrap",
  },
});

export default Religi;
